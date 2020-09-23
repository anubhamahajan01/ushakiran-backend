<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class DonationCategory extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\DonationCategory::class;

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
        'text'
    ];

    /**
    * The side nav menu order.
    *
    * @var int
    */
    public static $priority = 2;

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Donate';

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Text::make('Category Name', 'text')
                ->sortable()
                ->rules('required', 'max:50', 'min:3')
                ->creationRules('unique:donation_categories,text')
                ->updateRules('unique:donation_categories,text,{{resourceId}}'),

            Textarea::make('Details to be inputted for this category', 'tooltip')
                ->alwaysShow()
                ->rows(3)
                ->rules('required', 'min:6', 'max:250'),
            
            DateTime::make('Added on', 'created_at')->format('DD MMMM YYYY hh:mm A')
                ->hideWhenUpdating()
                ->hideWhenCreating(),

            Image::make('Category Icon', 'category_icon')
                ->rules('mimes:png', 'image', 'max:2000')
                ->creationRules('required')
                ->updateRules('nullable')
                ->store(function (Request $request, $model) {
                    if($media = $model->getMedia('category_icon')->first()){
                        $media->delete();
                    }
                    $model->addMediaFromRequest('category_icon')->toMediaCollection('category_icon');
                return [];
                })
                ->preview(function () {
                    return $this->getFirstMedia('category_icon') ? url($this->getFirstMedia('category_icon')->getUrl()) : '--';
                })
                ->deletable(false),
            
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
