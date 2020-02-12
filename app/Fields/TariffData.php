<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class TariffData extends Field
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

        $field = new FieldsBuilder('tariff', $defaults + ['graphql_field_name' => 'tariffData']);

        $field
            ->addAccordion('general')
            ->addTaxonomy('tariff_type', $defaults + ['field_type' => 'radio', 'taxonomy' => 'tariff_type', 'allow_null' => 0, 'add_term' => 0, 'save_terms' => 1, 'load_terms' => 1])
            ->addText('subline', $defaults)
            ->addTrueFalse('show_widget', $defaults + ['default_value' => 1])
            ->addRepeater(
                'features',
                $defaults + [
                    'button_label' => 'Add Feature',
                    'layout' => 'row'
                ]
            )
            ->addText('icon', $defaults)
            ->addText('content', $defaults)
            ->endRepeater();

        $field
            ->addAccordion('testimonials')
            ->addRepeater(
                'quotes',
                $defaults + [
                    'button_label' => 'Add Quote',
                    'layout' => 'row'
                ]
            )
            ->addTextarea('content', $defaults)
            ->addText('source', $defaults)
            ->addText('source_append', $defaults)
            ->addImage('image', $defaults)
            ->endRepeater();

        $field
            ->addAccordion('region')
            ->addGoogleMap('location', $defaults)
            ->addAccordion('partner')
            ->addText('name', $defaults)
            ->addImage('logo', $defaults);

        $field
            ->setLocation('post_type', '==', 'tariff');

        return $field->build();
    }
}
