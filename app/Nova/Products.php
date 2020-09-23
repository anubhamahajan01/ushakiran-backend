<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Http\Requests\NovaRequest;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;

class Products extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Product::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'text';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'text',
    ];

     /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Shop catalogues';

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [

            Text::make('Title', 'text')
                ->sortable()
                ->rules('required','min:3', 'max:50')
                ->creationRules('unique:products,text')
                ->updateRules('unique:products,text,{{resourceId}}'),

            Textarea::make('Description', 'description')
                ->alwaysShow()
                ->rules('required','min:3', 'max:150'),
            
            Text::make('Price (₹)', 'price')
                ->rules('required', 'regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/', 'max:12'),

            DateTime::make('Added on', 'created_at')->format('DD MMMM YYYY hh:mm A')
                ->hideWhenUpdating()
                ->hideWhenCreating(),

            Images::make('Product Images', 'product_image') // second parameter is the media collection name
                ->fullSize() // full size column
                ->rules('required', 'max:3') // validation rules for the collection of images
                ->singleImageRules('max:2000','dimensions:min_width=100'),

            HasMany::make('Users Interested in this product', 'interested_users', \App\Nova\User::class),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
