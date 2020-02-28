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
        $defaults = [
            'show_in_grapqhl' => 1,
        ];

        $field = new FieldsBuilder('power_station', $defaults + ['graphql_field_name' => 'powerStation']);

        $field
            ->addSelect('type', $defaults)
                ->addChoices('', ['water' => 'Water'], ['solar' => 'Solar'])
            ->addGoogleMap('location', $defaults);

        $field
            ->setLocation('taxonomy', '==', 'power_station');

        return $field->build();
    }
}
