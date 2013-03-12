<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ImportNativeXmlCommand extends CConsoleCommand {

    public function run($args) {
        // args[0] = Source file
        try {
            // Open source file
            $xml = simplexml_load_file($args[0]);

//            $this->preProcessParty($xml);
            $this->preProcessAddress($xml);

            $transaction = yii::app()->db->beginTransaction();

            foreach ($xml->children() as $xmlCfd) {
                // Get vendor rfc
                $vendorRfc = $xmlCfd->xpath("CfdParty[@type='" . CfdPartyTypeBehavior::VENDOR . "']/Party/PartyIdentifier[@type='" . IdentifierTypeBehavior::RFC . "']")[0];
//                $supplierId = $xmlCfd->xpath("CfdParty[@type='" . CfdPartyTypeBehavior::VENDOR . "']");
//                if (!$supplierId)
//                    $supplierId = $vendorRfc;
//                else
//                    $supplierId = $supplierId[0];
//
                // Get customer rfc
                $customerRfc = $xmlCfd->xpath("CfdParty[@type='" . CfdPartyTypeBehavior::CUSTOMER . "']/Party/PartyIdentifier[@type='" . IdentifierTypeBehavior::RFC . "']")[0];
//                $customerId = $xmlCfd->xpath("Party[@type='" . CfdPartyTypeBehavior::CUSTOMER . "']/PartyIdentifier[@type='" . IdentifierTypeBehavior::CUSTOMERID . "']")[0];
//                if (!$customerId)
//                    $customerId = $customerRfc;
//                else
//                    $customerId = $customerId[0];

//                if (!Cfd::model()->find('md5 = :md5', array(':md5' => cfd::model()->createMd5($vendorRfc->attributes()->value, $xmlCfd->attributes()->serial . $xmlCfd->attributes()->folio, $customerRfc->attributes()->value)))) {
                // Get vendor
                $vendor = $this->processParty($xmlCfd->xpath("CfdParty[@type='" . CfdPartyTypeBehavior::VENDOR . "']/Party")[0], CfdPartyTypeBehavior::VENDOR);
                // Get customer
                $customer = $this->processParty($xmlCfd->xpath("CfdParty[@type='" . CfdPartyTypeBehavior::CUSTOMER . "']/Party")[0], CfdPartyTypeBehavior::CUSTOMER);



//                $supplierRole = Role::model()->byCode('SUPPLIER')->byClass('Party')->find();
//                $supplierRole = PartyRole::model()
//                                ->byRole(Role::model()->byCode('SUPPLIER')->byClass('Party')->find())
//                                ->byParty($vendor)->find();
//
////                $customerRole = Role::model()->byCode('CUSTOMER')->byClass('Party')->find();
//                $customerRole = PartyRole::model()
//                                ->byRole(Role::model()->byCode('CUSTOMER')->byClass('Party')->find())
//                                ->byParty($customer)->find();
//
//                // Test supplier relationship
//                $found = PartyRelationship::model()
//                        ->byFromPartyRole($supplierRole)
//                        ->byToPartyRole($customerRole)
//                        ->byIdentifier((string) $supplierId->value)
//                        ->find();
//                $partyRelationship = ($found? : new PartyRelationship());
//                if ($partyRelationship->isNewRecord) {
//                    $partyRelationship->fromPartyRole = $supplierRole;
//                    $partyRelationship->toPartyRole = $customerRole;
//                    $partyRelationship->identifier = (string) $supplierId->attributes()->value;
//                    $partyRelationship->save();
//                }
//
//                // Test customer relationship
//                $found = PartyRelationship::model()
//                        ->byFromPartyRole($customerRole)
//                        ->byToPartyRole($supplierRole)
//                        ->byIdentifier((string) $customerId->value)
//                        ->find();
//                $partyRelationship = ($found? : new PartyRelationship());
//                if ($partyRelationship->isNewRecord) {
//                    $partyRelationship->fromPartyRole = $customerRole;
//                    $partyRelationship->toPartyRole = $supplierRole;
//                    $partyRelationship->identifier = (string) $customerId->attributes()->value;
//                    $partyRelationship->save();
//                }
                echo yii::t('yanus', 'Processing invoice {nbr}.', array('{nbr}' => $xmlCfd->attributes()->serial . $xmlCfd->attributes()->folio)) . PHP_EOL;

                $md5 = Cfd::model()->createMd5($vendorRfc->attributes()->value, $xmlCfd->attributes()->serial . $xmlCfd->attributes()->folio, $customerRfc->attributes()->value);
                if (!Cfd::model()->byMd5($md5)->find()) {

                    // Create CFD
                    $cfd = new Cfd();
                    foreach ($xmlCfd->attributes() as $name => $value) {
                        $cfd->$name = $value;
                    }
                    $cfd->invoice = $xmlCfd->attributes()->serial . '-' . $xmlCfd->attributes()->folio;
                    $cfd->md5 = $md5;
                    // Find valid certificate
                    $cfd->satCertificate = SatCertificate::model()->validAsOf(new DateTime($xmlCfd->attributes()->dttm))->byRfc($vendorRfc->attributes()->value)->find();
                    if (!$cfd->paymentMethod)
                        $cfd->paymentMethod = 'NO IDENTIFICADO';
                    foreach ($xmlCfd->children() as $child) {
                        $this->processNode($child, $cfd);
                    }
                    $cfd->save();
                } else
                    echo yii::t('yanus', 'Invoice {invoice} already exists.', array('{invoice}' => $xmlCfd->attributes()->serial . $xmlCfd->attributes()->folio)) . PHP_EOL;
            }
            $transaction->commit();
        } catch (Exception $e) {
            yii::trace($e->getMessage(), __METHOD__);
            $transaction->rollback();
        }
    }

    private function processNode($node, $parentModel = null) {
        echo 'Processing ' . $node->getName() . PHP_EOL;
        switch ($node->getName()) {
            case 'Annotation':
                $model = Annotation::model()->find('md5 = :md5', array(':md5' => md5($node->attributes()->note)));
                if (!$model) {
                    $model = new Annotation();
                    foreach ($node->attributes() as $name => $value) {
                        $model->$name = $value;
                    }
                    $model->save();
                }
                $parentModel->Annotation_id = $model->id;
                break;

            case 'CfdAddress':
                // Get Address node
                $addressNode = $node->children()[0];
                $cfdAddress = new CfdAddress();
                foreach ($node->attributes() as $name => $value) {
                    $cfdAddress->$name = $value;
                }
                $cfdAddress->address = $this->processAddress($addressNode);
                $parentModel->addRelatedObject($cfdAddress);
                break;
            case 'CfdParty':
                // Get party node
                $partyNode = $node->children()[0];
                $cfdParty = new CfdParty();
                foreach ($node->attributes() as $name => $value) {
                    $cfdParty->$name = $value;
                }
                $cfdParty->party = $this->processParty($partyNode, $node->attributes()->type);
                $parentModel->addRelatedObject($cfdParty);
                break;
            case 'Currency':
                $currency = false;
                if ($node->attributes()->code)
                    $currency = Currency::model()->find('code = :code', array(':code' => $node->attributes()->code));
                elseif ($node->attributes()->name)
                    $currency = Currency::model()->find('name = :name', array(':name' => $node->attributes()->name));
                if (!$currency) {
                    $currency = new Currency();
                    foreach ($node->attributes() as $name => $value) {
                        $currency->$name = $value;
                    }
                    $currency->save();
                }
                $parentModel->currency = $currency;
                break;
            case 'CustomsPermit':
                $model = CustomsPermit::model()->find('nbr = :nbr', array(':nbr' => $node->attributes()->nbr));
                if (!$model) {
                    $model = new CustomsPermit();
                    foreach ($node->attributes() as $name => $value) {
                        $model->$name = $value;
                    }
                    $model->save();
                }
                $parentModel->CustomsPermit_id = $model->id;
                break;

            case 'Party':
                $parentModel->addRelatedObject($this->processParty($node));
                break;
            case 'PaymentTerm':
                $paymentTerm = false;
                if ($node->attributes()->code)
                    $paymentTerm = PaymentTerm::model()->find('code = :code', array(':code' => $node->attributes()->code));
                elseif ($node->attributes()->name)
                    $paymentTerm = PaymentTerm::model()->find('name = :name', array(':name' => $node->attributes()->name));
                if (!$paymentTerm) {
                    $paymentTerm = new PaymentTerm();
                    foreach ($node->attributes() as $name => $value) {
                        $paymentTerm->$name = $value;
                    }
                    $paymentTerm->save();
                }
                $parentModel->paymentTerm = $paymentTerm;
                break;
            default:
                if ($parentModel) {
                    switch ($node->getName()) {

                        case 'Name':
                        case 'Address':
                            $found = $model->find('md5 = :md5', array(':md5' => $model->getMd5()));
                            if ($found)
                                $model = $found;
                            break;
                        case 'Identifier':
                            $found = Identifier::model()->find('type = :type and value = :value', array(':type' => $model->type, ':value' => $model->value));
                            if ($found)
                                $model = $found;
                            break;
                        default:
                            // Process
                            $modelName = $node->getName();
                            $model = new $modelName;
                            foreach ($node->attributes() as $name => $value) {
                                $model->$name = $value;
                            }
                    }
                    $parentModel->addRelatedObject($model);
                }
                foreach ($node->children() as $child) {
                    $this->processNode($child, $model);
                }
        }
    }

    private function preProcessAddress($xml) {
        // Process addresses
        $addreses = $xml->xpath("Cfd/CfdAddress/Address");
        foreach ($addreses as $address) {
            // Find Country
            if (!(string) $address->attributes()->country) {
                $countryCode = 'N/A';
                $countryName = yii::t('yanus', 'Unidentified Country');
            } else
                $countryCode = (string) $address->attributes()->country;
            $country = Country::model()->find('code = :code', array(':code' => $countryCode));
            if (!$country) {
                if ($countryCode != 'N/A') {
                    // Find by geocode
                    $geo = yii::app()->geocode->query((string) $address->attributes()->country, array('language' => 'es'));
                    if ($geo)
                        $countryName = $geo->country->long_name;
                }
                $country = new Country();
                $country->code = $countryCode;
                $country->name = $countryName;
                $country->save();
            }
            // Find state
            $state = false;
            if (!(string) $address->attributes()->state) {
                $stateCode = 'N/A';
                $stateName = yii::t('yanus', 'Unidentified State');
            } else
                $stateCode = (string) $address->attributes()->state;
            $state = State::model()->find('code = :code and Country_id = :id', array(':code' => $stateCode, ':id' => $country->id));
            if (!$state) {
                if ($stateCode != 'N/A') {
                    // Find by geocode
                    $strAddress = '';
                    if ((string) $address->attributes()->city)
                        $strAddress .= (string) $address->attributes()->city . ',';
                    if ((string) $address->attributes()->state)
                        $strAddress .= (string) $address->attributes()->state . ',';
                    $strAddress .= (string) $address->attributes()->zipCode . ',';
                    $strAddress .= (string) $address->attributes()->country;
                    $geo = yii::app()->geocode->query($strAddress, array('language' => 'es'));
                    if ($geo)
                        $stateName = $geo->state->long_name;
                    else
                        $stateName = yii::t('yanus', 'Unidentified State');
                }
                $state = new State();
                $state->code = $stateCode;
                $state->name = $stateName;
                $state->country = $country;
                $state->save();
            }
            $cfdAddress = new Address();
            foreach ($address->attributes() as $name => $value) {
                switch ($name) {
                    case 'country':
                    case 'state':
                        break;
                    default:
                        $cfdAddress->$name = $value;
                }
            }
            $cfdAddress->state = $state;
            if (!Address::model()->find('md5 = :md5', array(':md5' => $cfdAddress->getMd5())))
                $cfdAddress->save();
        }
    }

    private function processAddress($node) {
        $address = new Address();
        $countryCode = false;
        $stateCode = false;
        foreach ($node->attributes() as $name => $value) {
            switch ($name) {
                case 'country':
                    $countryCode = $value;
                    break;
                case 'state':
                    $stateCode = $value;
                    break;
                default:
                    $address->$name = $value;
            }
        }
        // Find country by code
        if (!$countryCode)
            $countryCode = 'N/A';
        if (!$stateCode)
            $stateCode = 'N/A';
//        $country = Country::model()->find('code = :code', array(':code' => $countryCode));
        // Find State by code and country
//        $state = State::model()->with('country')->find('code = :code and country.code = :country', array(':code' => $stateCode, ':code' => $countryCode));
        $address->state = State::model()->with('country')->find('t.code = :code and country.code = :country', array(':code' => $stateCode, ':country' => $countryCode));
        $address = (address::model()->find('md5 = :md5', array(':md5' => $address->getMd5()))? : $address);
        if ($address->isNewRecord)
            $address->save();
        return $address;
    }

    /**
     * Process parties.
     * Update or create parties reported on the XML
     * @param type $xml
     */
    private function preProcessParty($xml) {
        // Process parties
//        $vendors = $xml->xpath("Cfd/CfdParty[@type='" . CfdPartyTypeBehavior::VENDOR . "']");
        $partyNodes = $xml->xpath("Cfd/CfdParty");
        foreach ($partyNodes as $partyNode) {
//            CVarDumper::dump($partyNode);
            // Get vendor RFC
            $identifierNode = $partyNode->xpath("Party/PartyIdentifier[@type='" . IdentifierTypeBehavior::RFC . "']")[0];
//            if ($identifierNode) {
//                $found = Identifier::model()->byType($identifierNode->attributes()->type)->byValue($identifierNode->attributes()->value)->find();
////                $found = Identifier::model()->find('type = :type and value = :value', array(':type' => $identifierNode->attributes()->type, ':value' => $identifierNode->attributes()->value));
//                $identifier = ($found? : new Identifier());
//                if ($identifier->isNewRecord) {
//                    foreach ($identifierNode->attributes() as $name => $value) {
//                        $identifier->$name = $value;
//                    }
//                    if (!$identifier->save())
//                        CVarDumper::dump($identifier->getErrors());
//                }
//            }
            // Get vendor NAME
            $nameNode = $partyNode->xpath("Party/PartyName[@type='" . PartyNameTypeBehavior::PRIMARY . "']/Name")[0];
            if ($nameNode) {
                $name = new Name();
                foreach ($nameNode->attributes() as $attr => $value) {
                    $name->$attr = $value;
                }
                $found = Name::model()->byMd5($name->getMd5())->find();
                $name = ($found? : $name);
                if ($name->isNewRecord)
                    if (!$name->save())
                        CVarDumper::dump($name->getErrors());
            }
            // Find vendor by RFC
//            $found = Party::model()->findByIdentifier($identifier);
            $identifier = new PartyIdentifier();
            foreach ($identifierNode->attributes() as $attributeName => $attributeValue) {
                $identifier->$attributeName = $attributeValue;
            }

            $found = Party::model()->byName($name)->find();

            $party = ($found? : new Party());
            if ($party->isNewRecord) {
                // The party was not found.
                $party->person = (float) (strlen($identifier->value) == 13);
                $party->addRelatedObject($identifier);
//                $party->addIdentifier(PartyIdentifierTypeBehavior::PRIMARY, $identifier);
                $party->addName(PartyNameTypeBehavior::PRIMARY, $name);
                switch ($partyNode->attributes()->type) {
                    case CfdPartyTypeBehavior::VENDOR:
                        $role = Role::model()->byCode('SUPPLIER')->byClass('Party')->find();
                        break;
                    case CfdPartyTypeBehavior::CUSTOMER:
                        $role = Role::model()->byCode('CUSTOMER')->byClass('Party')->find();
                        break;
                }
                $party->addRole($role);
            } else {
                // The party was found BY NAME
                // Test if something has changed.
                if ($party->rfc != $identifier->value)
                    $party->addRelatedObject($identifier);
//                if ($party->name->md5 != $name->md5)
//                    $party->addName(PartyNameTypeBehavior::PRIMARY, $name);
                // test if it's a supplier
                switch ($partyNode->attributes()->type) {
                    case CfdPartyTypeBehavior::VENDOR:
                        $role = Role::model()->byCode('SUPPLIER')->byClass('Party')->find();
                        if (!Party::model()->byRole($role)->find())
                            $party->addRole($role);
                        break;
                    case CfdPartyTypeBehavior::CUSTOMER:
                        $role = Role::model()->byCode('CUSTOMER')->byClass('Party')->find();
                        if (!Party::model()->byRole($role)->find())
                            $party->addRole($role);
                        break;
                }
            }
//            // Process other identifiers
//            $identifierNodes = $partyNode->xpath("Party/PartyIdentifier[@type!='" . IdentifierTypeBehavior::RFC . "']");
//            foreach ($identifierNodes as $identifierNode) {
//                $found = Identifier::model()->byType($identifierNode->attributes()->type)->byValue($identifierNode->attributes()->value)->find();
//                $identifier = ($found? : new Identifier());
//                if ($identifier->isNewRecord) {
//                    foreach ($identifierNode->attributes() as $name => $value) {
//                        $identifier->$name = $value;
//                    }
//                    if (!$identifier->save())
//                        CVarDumper::dump($identifier->getErrors());
//                }
//                if ($party->isNewRecord || !$party->findPartyIdentifier($identifier->type, $identifier->value))
//                    $party->addIdentifier(PartyIdentifierTypeBehavior::ALTERNATE, $identifier);
//            }
//            // Process other names
//            $nameNodes = $partyNode->xpath("Party/PartyName[@type!='" . PartyNameTypeBehavior::PRIMARY . "']/Name");
//            foreach ($nameNodes as $nameNode) {
//                $name = new Name();
//                foreach ($nameNode->attributes() as $attr => $value) {
//                    $name->$attr = $value;
//                }
//                $found = Name::model()->find('md5 = :md5', array(':md5' => $name->getMd5()));
//                $name = ($found? : $name);
//                if ($name->isNewRecord)
//                    if (!$name->save())
//                        CVarDumper::dump($name->getErrors());
//            }
            if ($party->isDirty())
                if (!$party->save())
                    CVarDumper::dump($party->getErrors());
        }
    }

    private function processParty($partyNode, $cfdPartyType) {
        // Get party RFC
        $identifierNode = $partyNode->xpath("PartyIdentifier[@type='" . IdentifierTypeBehavior::RFC . "']")[0];
        $identifier = new PartyIdentifier();
        foreach ($identifierNode->attributes() as $attributeName => $attributeValue) {
            $identifier->$attributeName = $attributeValue;
        }

        // Get party NAME
        $nameNode = $partyNode->xpath("PartyName[@type='" . PartyNameTypeBehavior::PRIMARY . "']/Name")[0];
        if ($nameNode) {
            $name = new Name();
            foreach ($nameNode->attributes() as $attr => $value) {
                $name->$attr = $value;
            }
            $found = Name::model()->byMd5($name->getMd5())->find();
            $name = ($found? : $name);
            if ($name->isNewRecord)
                if (!$name->save())
                    CVarDumper::dump($name->getErrors());
        }
        $found = Party::model()->byName($name)->find();
        $party = ($found? : new Party());
        if ($party->isNewRecord) {
            // The party was not found.
            $party->person = (float)(strlen((string) $identifierNode->attributes()->value) == 13);
            $party->addRelatedObject($identifier);
            $party->addName(PartyNameTypeBehavior::PRIMARY, $name);
            switch ($cfdPartyType) {
                case CfdPartyTypeBehavior::VENDOR:
                    $role = Role::model()->byCode('SUPPLIER')->byClass('Party')->find();
                    break;
                case CfdPartyTypeBehavior::CUSTOMER:
                    $role = Role::model()->byCode('CUSTOMER')->byClass('Party')->find();
                    break;
            }
            $party->addRole($role);
        } else {
            // The party was found BY NAME
            // Test if something has changed.
            if ($party->rfc != $identifier->value)
                $party->addRelatedObject($identifier);
            // test if it's a supplier
            switch ($cfdPartyType) {
                case CfdPartyTypeBehavior::VENDOR:
                    $role = Role::model()->byCode('SUPPLIER')->byClass('Party')->find();
                    if (!Party::model()->byRole($role)->find())
                        $party->addRole($role);
                    break;
                case CfdPartyTypeBehavior::CUSTOMER:
                    $role = Role::model()->byCode('CUSTOMER')->byClass('Party')->find();
                    if (!Party::model()->byRole($role)->find())
                        $party->addRole($role);
                    break;
            }
        }
        if ($party->isDirty())
            if (!$party->save())
                CVarDumper::dump($party->getErrors());

        return $party;

        // Process parties
//        $vendors = $xml->xpath("Cfd/CfdParty[@type='" . CfdPartyTypeBehavior::VENDOR . "']");
        $partyNodes = $xml->xpath("Cfd/CfdParty");
        foreach ($partyNodes as $partyNode) {
//            CVarDumper::dump($partyNode);
            // Get vendor RFC
            $identifierNode = $partyNode->xpath("Party/PartyIdentifier[@type='" . IdentifierTypeBehavior::RFC . "']")[0];
//            if ($identifierNode) {
//                $found = Identifier::model()->byType($identifierNode->attributes()->type)->byValue($identifierNode->attributes()->value)->find();
////                $found = Identifier::model()->find('type = :type and value = :value', array(':type' => $identifierNode->attributes()->type, ':value' => $identifierNode->attributes()->value));
//                $identifier = ($found? : new Identifier());
//                if ($identifier->isNewRecord) {
//                    foreach ($identifierNode->attributes() as $name => $value) {
//                        $identifier->$name = $value;
//                    }
//                    if (!$identifier->save())
//                        CVarDumper::dump($identifier->getErrors());
//                }
//            }
            // Get vendor NAME
            $nameNode = $partyNode->xpath("Party/PartyName[@type='" . PartyNameTypeBehavior::PRIMARY . "']/Name")[0];
            if ($nameNode) {
                $name = new Name();
                foreach ($nameNode->attributes() as $attr => $value) {
                    $name->$attr = $value;
                }
                $found = Name::model()->byMd5($name->getMd5())->find();
                $name = ($found? : $name);
                if ($name->isNewRecord)
                    if (!$name->save())
                        CVarDumper::dump($name->getErrors());
            }
            // Find vendor by RFC
//            $found = Party::model()->findByIdentifier($identifier);
            $identifier = new PartyIdentifier();
            foreach ($identifierNode->attributes() as $attributeName => $attributeValue) {
                $identifier->$attributeName = $attributeValue;
            }

            $found = Party::model()->byName($name)->find();

            $party = ($found? : new Party());
            if ($party->isNewRecord) {
                // The party was not found.
                $party->person = (float) (strlen($identifier->value) == 13);
                $party->addRelatedObject($identifier);
//                $party->addIdentifier(PartyIdentifierTypeBehavior::PRIMARY, $identifier);
                $party->addName(PartyNameTypeBehavior::PRIMARY, $name);
                switch ($partyNode->attributes()->type) {
                    case CfdPartyTypeBehavior::VENDOR:
                        $role = Role::model()->byCode('SUPPLIER')->byClass('Party')->find();
                        break;
                    case CfdPartyTypeBehavior::CUSTOMER:
                        $role = Role::model()->byCode('CUSTOMER')->byClass('Party')->find();
                        break;
                }
                $party->addRole($role);
            } else {
                // The party was found BY NAME
                // Test if something has changed.
                if ($party->rfc != $identifier->value)
                    $party->addRelatedObject($identifier);
//                if ($party->name->md5 != $name->md5)
//                    $party->addName(PartyNameTypeBehavior::PRIMARY, $name);
                // test if it's a supplier
                switch ($partyNode->attributes()->type) {
                    case CfdPartyTypeBehavior::VENDOR:
                        $role = Role::model()->byCode('SUPPLIER')->byClass('Party')->find();
                        if (!Party::model()->byRole($role)->find())
                            $party->addRole($role);
                        break;
                    case CfdPartyTypeBehavior::CUSTOMER:
                        $role = Role::model()->byCode('CUSTOMER')->byClass('Party')->find();
                        if (!Party::model()->byRole($role)->find())
                            $party->addRole($role);
                        break;
                }
            }
//            // Process other identifiers
//            $identifierNodes = $partyNode->xpath("Party/PartyIdentifier[@type!='" . IdentifierTypeBehavior::RFC . "']");
//            foreach ($identifierNodes as $identifierNode) {
//                $found = Identifier::model()->byType($identifierNode->attributes()->type)->byValue($identifierNode->attributes()->value)->find();
//                $identifier = ($found? : new Identifier());
//                if ($identifier->isNewRecord) {
//                    foreach ($identifierNode->attributes() as $name => $value) {
//                        $identifier->$name = $value;
//                    }
//                    if (!$identifier->save())
//                        CVarDumper::dump($identifier->getErrors());
//                }
//                if ($party->isNewRecord || !$party->findPartyIdentifier($identifier->type, $identifier->value))
//                    $party->addIdentifier(PartyIdentifierTypeBehavior::ALTERNATE, $identifier);
//            }
//            // Process other names
//            $nameNodes = $partyNode->xpath("Party/PartyName[@type!='" . PartyNameTypeBehavior::PRIMARY . "']/Name");
//            foreach ($nameNodes as $nameNode) {
//                $name = new Name();
//                foreach ($nameNode->attributes() as $attr => $value) {
//                    $name->$attr = $value;
//                }
//                $found = Name::model()->find('md5 = :md5', array(':md5' => $name->getMd5()));
//                $name = ($found? : $name);
//                if ($name->isNewRecord)
//                    if (!$name->save())
//                        CVarDumper::dump($name->getErrors());
//            }
            if ($party->isDirty())
                if (!$party->save())
                    CVarDumper::dump($party->getErrors());
        }



//        // Find primary identifier
//        $primaryIdentifier = $node->xpath("PartyIdentifier[@type='primary']/Identifier")[0];
//
//        // Find party with this primary identifier.
//        $found = Party::model()->findByPartyIdentifierValue($primaryIdentifier->attributes()->type, $primaryIdentifier->attributes()->value);
//        $party = ($found? : new Party());
//
//        if ($party->isNewRecord) {
//            echo 'Party not found' . PHP_EOL;
//            // Process
//            foreach ($node->children() as $child) {
//                switch ($child->getName()) {
//                    case 'PartyIdentifier':
//                        // Find the identifier
//                        $identifierNode = $child->children()[0];
//                        $found = Identifier::model()->find('type = :type and value = :value', array(':type' => $identifierNode->attributes()->type, ':value' => $identifierNode->attributes()->value));
//                        $identifier = ($found? : new Identifier());
//                        if ($identifier->isNewRecord) {
//                            foreach ($identifierNode->attributes() as $name => $value) {
//                                $identifier->$name = $value;
//                            }
//                            $identifier->save();
//                        }
//                        $partyIdentifier = new PartyIdentifier();
//                        foreach ($child->attributes() as $name => $value) {
//                            $partyIdentifier->$name = $value;
//                        }
//                        $partyIdentifier->identifier = $identifier;
//                        $party->addRelatedObject($partyIdentifier);
//                        break;
//                    case 'PartyName':
//                        // Find the name
//                        $nameNode = $child->children()[0];
//                        $name = new Name();
//                        foreach ($nameNode->attributes() as $attr => $value) {
//                            $name->$attr = $value;
//                        }
//                        $found = Name::model()->find('md5 = :md5', array(':md5' => $name->getMd5()));
//                        $name = ($found? : $name);
//                        if ($name->isNewRecord)
//                            $name->save();
//
//                        $partyName = new PartyName();
//                        foreach ($child->attributes() as $attr => $value) {
//                            $partyName->$attr = $value;
//                        }
//                        $partyName->name = $name;
//                        $party->addRelatedObject($partyName);
//                        break;
//                }
//            }
//            $party->save();
//        } else {
//            foreach ($node->children() as $child) {
//                switch ($child->getName()) {
//                    case 'PartyIdentifier':
//                        // Find the identifier
//                        $identifierNode = $child->children()[0];
//                        $found = Identifier::model()->find('type = :type and value = :value', array(':type' => $identifierNode->attributes()->type, ':value' => $identifierNode->attributes()->value));
//                        $identifier = ($found? : new Identifier());
//                        if ($identifier->isNewRecord) {
//                            foreach ($identifierNode->attributes() as $name => $value) {
//                                $identifier->$name = $value;
//                            }
//                            $identifier->save();
//                        }
//
//                        $partyIdentifier = ($party->findPartyIdentifier($identifierNode->attributes()->type, $identifierNode->attributes()->value, $child->attributes()->type)? : new PartyIdentifier());
////                        $found = $party->findPartyIdentifier($identifierNode->attributes()->type, $identifierNode->attributes()->value, $child->attributes()->type);
////                        $partyIdentifier = ($found? : new PartyIdentifier());
//                        if ($partyIdentifier->isNewRecord) {
//                            $partyIdentifier = new PartyIdentifier();
//                            foreach ($child->attributes() as $name => $value) {
//                                $partyIdentifier->$name = $value;
//                            }
//                            $partyIdentifier->identifier = $identifier;
//                            $party->addRelatedObject($partyIdentifier);
//                        }
//                        break;
//                    case 'PartyName':
//                        // Find the name
//                        $nameNode = $child->children()[0];
//                        $name = new Name();
//                        foreach ($nameNode->attributes() as $attr => $value) {
//                            $name->$attr = $value;
//                        }
//                        $found = Name::model()->find('md5 = :md5', array(':md5' => $name->getMd5()));
//                        $name = ($found? : $name);
//                        if ($name->isNewRecord)
//                            $name->save();
//                        switch ($child->attributes()->type) {
//                            case PartyNameTypeBehavior::PRIMARY:
//                                if ($party->primaryName->name->md5 != $name->md5) {
//                                    $partyName = new PartyName();
//                                    foreach ($child->attributes() as $attr => $value) {
//                                        $partyName->$attr = $value;
//                                    }
//                                    $partyName->name = $name;
//                                    $party->addRelatedObject($partyName);
//                                }
//                                break;
//                            default:
//                                $partyName = $party->findPartyName($name, $child->attributes()->type, false);
//                                $partyName = ($partyName? : new PartyName());
//                                if ($partyName->isNewRecord) {
//                                    foreach ($child->attributes() as $attr => $value) {
//                                        $partyName->$attr = $value;
//                                    }
//                                    $partyName->name = $name;
//                                    $party->addRelatedObject($partyName);
//                                }
//                        }
//                        break;
//                }
//            }
//            if ($party->isDirty())
//                $party->save();
//        }
//        return $party;
    }

}

?>
