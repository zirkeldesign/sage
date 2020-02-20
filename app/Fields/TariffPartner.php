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
        $defaults = [
            'show_in_grapqhl' => 1,
        ];

        $field = new FieldsBuilder('tariff_partner', $defaults + ['graphql_field_name' => 'tariffPartner']);

        $field
            ->addImage('logo', $defaults);

        $field
            ->setLocation('taxonomy', '==', 'tariff_partner');

        return $field->build();
    }
}
