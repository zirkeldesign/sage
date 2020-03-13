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
        $field = new FieldsBuilder('tariff', ['graphql_field_name' => 'tariffData']);

        $field
            ->addAccordion('general')
            ->addTaxonomy('tariff_type', ['field_type' => 'radio', 'taxonomy' => 'tariff_type', 'allow_null' => 0, 'add_term' => 0, 'save_terms' => 1, 'load_terms' => 1])
            ->addText('subline')
            ->addTrueFalse('show_widget', ['default_value' => 1])
            ->addRepeater(
                'features',
                [
                    'button_label' => 'Add Feature',
                    'layout' => 'row'
                ]
            )
            ->addText('icon')
            ->addText('content')
            ->endRepeater();

        $field
            ->addAccordion('testimonials')
            ->addRepeater(
                'quotes',
                [
                    'button_label' => sprintf(__('Add %s', 'sage'), __('Quote', 'sage')),
                    'layout' => 'row'
                ]
            )
            ->addTextarea('content')
            ->addText('source')
            ->addText('source_append')
            ->addImage('image')
            ->endRepeater();

        $field
            ->addAccordion('images')
            ->addRepeater(
                'images',
                [
                    'button_label' => sprintf(__('Add %s', 'sage'), __('Image', 'sage')),
                    'layout' => 'row',
                    'max' => 3
                ]
            )
            ->addImage('image')
            ->addTextarea('description')
            ->addText('title')
            ->endRepeater();

        $field
            ->addAccordion('region')
            ->addGoogleMap('location')
            ->addImage('map')
            ->addWysiwyg('content')
            ->addTaxonomy('power_station', ['field_type' => 'multi_select', 'taxonomy' => 'power_station', 'allow_null' => 1, 'add_term' => 1, 'save_terms' => 1, 'load_terms' => 1]);

        $field
            ->addAccordion('partner')
            ->addTaxonomy('tariff_partner', ['field_type' => 'multi_select', 'taxonomy' => 'tariff_partner', 'allow_null' => 1, 'add_term' => 1, 'save_terms' => 1, 'load_terms' => 1]);

        $field
            ->setLocation('post_type', '==', 'tariff');

        return $field->build();
    }
}
