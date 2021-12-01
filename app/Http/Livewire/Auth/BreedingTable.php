<?php

namespace App\Http\Livewire\Auth;

use App\Models\Breeding;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;

class BreedingTable extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp()
    {
        $this->sortField = 'litter_no';
        $this->showPerPage()
            ->showExportOption('download', ['excel', 'csv'])
            ->showSearchInput()
            ->sortBy('litter_no');
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */
    public function datasource()
    : ?Builder
    {
        return Breeding::query()
            ->selectRaw('breedings.*, pd.tag_id, pb.tag_id')
            ->leftJoin('rabbits as pd', 'pd.id', '=', 'breedings.parent_doe')
            ->leftJoin('rabbits as pb', 'pb.id', '=', 'breedings.parent_buck');
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */
    public function relationSearch()
    : array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    */
    public function addColumns()
    : ?PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('litter_no', function (Breeding $model) {
                return "<div class='text-nowrap'>$model->litter_no</div>";
            })
            ->addColumn('cage_no')
            ->addColumn('parent_doe', function (Breeding $model) {
                return $model->dam()->get()[0]->tag_id ?? '';
            })
            ->addColumn('parent_buck', function (Breeding $model) {
                return $model->sire()->get()[0]->tag_id ?? '';
            })
            ->addColumn('date_bred_formatted', function (Breeding $model) {
                return Carbon::parse($model->date_bred)->format('Y-m-d');
            })
            ->addColumn('expected_kindle_date_formatted', function (Breeding $model) {
                return Carbon::parse($model->expected_kindle_date)->format('Y-m-d');
            })
            ->addColumn('kindle_date_formatted', function (Breeding $model) {
                return Carbon::parse($model->kindle_date)->format('Y-m-d');
            })
            ->addColumn('weaning_date_formatted', function (Breeding $model) {
                return Carbon::parse($model->weaning_date)->format('Y-m-d');
            })
            ->addColumn('planned_rebreed_date_formatted', function (Breeding $model) {
                return Carbon::parse($model->planned_rebreed_date)->format('Y-m-d');
            })
            ->addColumn('isRebreed')
            ->addColumn('born_alive')
            ->addColumn('born_dead')
            ->addColumn('total_kits')
            ->addColumn('born_doe')
            ->addColumn('born_buck')
            ->addColumn('notes');
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */
    public function columns()
    : array
    {
        return [

            Column::add()
                ->title(__('LITTER NO'))
                ->field('litter_no')
                ->sortable('litter_no')
                ->searchable('litter_no'),
            Column::add()
                ->title(__('CAGE NO'))
                ->field('cage_no')
                ->sortable('cage_no')
                ->searchable('cage_no'),

            Column::add()
                ->title(__('PARENT DOE'))
                ->field('parent_doe')
                ->sortable('pd.tag_id')
                ->searchable('pd.tag_id'),

            Column::add()
                ->title(__('PARENT BUCK'))
                ->field('parent_buck')
                ->sortable('pb.tag_id')
                ->searchable('pb.tag_id'),

            Column::add()
                ->title(__('DATE BRED'))
                ->field('date_bred_formatted')
                ->searchable('date_bred')
                ->sortable('date_bred'),

            Column::add()
                ->title(__('EXPECTED KINDLE DATE'))
                ->field('expected_kindle_date_formatted')
                ->searchable('expected_kindle_date')
                ->sortable('expected_kindle_date'),

            Column::add()
                ->title(__('KINDLE DATE'))
                ->field('kindle_date_formatted')
                ->searchable('kindle_date')
                ->sortable('kindle_date'),

            Column::add()
                ->title(__('WEANING DATE'))
                ->field('weaning_date_formatted')
                ->searchable('weaning_date')
                ->sortable('weaning_date'),

            Column::add()
                ->title(__('PLANNED REBREED DATE'))
                ->field('planned_rebreed_date_formatted')
                ->searchable('planned_rebreed_date')
                ->sortable('planned_rebreed_date'),

            Column::add()
                ->title(__('ISREBREED'))
                ->field('isRebreed'),

            Column::add()
                ->title(__('BORN ALIVE'))
                ->field('born_alive'),

            Column::add()
                ->title(__('BORN DEAD'))
                ->field('born_dead'),

            Column::add()
                ->title(__('TOTAL KITS'))
                ->field('total_kits'),

            Column::add()
                ->title(__('BORN DOE'))
                ->field('born_doe'),

            Column::add()
                ->title(__('BORN BUCK'))
                ->field('born_buck'),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable this section only when you have defined routes for these actions.
    |
    */

    /*
    public function actions(): array
    {
       return [
           Button::add('edit')
               ->caption(__('Edit'))
               ->class('bg-indigo-500 text-white')
               ->route('breeding.edit', ['breeding' => 'id']),

           Button::add('destroy')
               ->caption(__('Delete'))
               ->class('bg-red-500 text-white')
               ->route('breeding.destroy', ['breeding' => 'id'])
               ->method('delete')
        ];
    }
    */

    /*
    |--------------------------------------------------------------------------
    | Edit Method
    |--------------------------------------------------------------------------
    | Enable this section to use editOnClick() or toggleable() methods
    |
    */

    /*
    public function update(array $data ): bool
    {
       try {
           $updated = Breeding::query()->find($data['id'])->update([
                $data['field'] => $data['value']
           ]);
       } catch (QueryException $exception) {
           $updated = false;
       }
       return $updated;
    }

    public function updateMessages(string $status, string $field = '_default_message'): string
    {
        $updateMessages = [
            'success'   => [
                '_default_message' => __('Data has been updated successfully!'),
                //'custom_field' => __('Custom Field updated successfully!'),
            ],
            'error' => [
                '_default_message' => __('Error updating the data.'),
                //'custom_field' => __('Error updating custom field.'),
            ]
        ];

        return ($updateMessages[$status][$field] ?? $updateMessages[$status]['_default_message']);
    }
    */

    public function template()
    : ?string
    {
        return null;
    }

}
