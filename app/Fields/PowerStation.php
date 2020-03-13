<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class PowerStation extends Field
{
    /**
     * Fields to be registered with the application.
     *
     * @return array
     */
    public function fields()
    {
        $field = new FieldsBuilder('power_station', ['graphql_field_name' => 'powerStation']);

        $field
            ->addSelect('type')
            ->addChoices('', ['wind' => __('Wind', 'sage')], ['water' => __('Water', 'sage')], ['solar' => __('Solar', 'sage')])
            ->addGoogleMap('location');

        $field
            ->setLocation('taxonomy', '==', 'power_station');

        return $field->build();
    }
}
