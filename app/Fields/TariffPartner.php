<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class TariffPartner extends Field
{
    /**
     * Fields to be registered with the application.
     *
     * @return array
     */
    public function fields()
    {
        $field = new FieldsBuilder('tariff_partner', ['graphql_field_name' => 'tariffPartner']);

        $field
            ->addText('short_name')
            ->addImage('logo')
            ->addLink('website');

        $field
            ->setLocation('taxonomy', '==', 'tariff_partner');

        return $field->build();
    }
}
