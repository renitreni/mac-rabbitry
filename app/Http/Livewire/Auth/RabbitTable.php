<?php

namespace App\Http\Livewire\Auth;

use App\Models\Breeding;
use App\Models\Members;
use App\Models\Rabbit;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;

class RabbitTable extends PowerGridComponent
{
    use ActionButton;

    public int $total;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp()
    {
        $this->sortField = 'tag_id';
        $this->showPerPage()
            ->showExportOption('download', ['excel', 'csv'])
            ->showSearchInput()
            ->sortBy('tag_id');
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
        Rabbit::draftCleaner();

        (new Rabbit())->idGenerator();
        (new Breeding())->idGenerator();

        return Rabbit::query()
            ->selectRaw('rabbits.*, c.name, b.name, rs.name')
            ->leftJoin('categories as c', 'c.id', '=', 'rabbits.category_id')
            ->leftJoin('breeds as b', 'b.id', '=', 'rabbits.breed_id')
            ->leftJoin('rabbit_statuses as rs', 'rs.id', '=', 'rabbits.status_id')
            ->where('org_id', Members::getOrgID(auth()->id()));
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
    : PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('tag_id', function (Rabbit $model) {
                return "<div class='text-nowrap'>$model->tag_id</div>";
            })
            ->addColumn('breeding_id')
            ->addColumn('cage_no')
            ->addColumn('c.name', function (Rabbit $model) {
                return $model->category->name ?? '';
            })
            ->addColumn('b.name', function (Rabbit $model) {
                return $model->breed->name ?? '';
            })
            ->addColumn('rs.name', function (Rabbit $model) {
                return $model->status->name ?? '';
            })
            ->addColumn('dob', function (Rabbit $model) {
                return "<div class='text-nowrap'>".Carbon::parse($model->dob)->format('Y-m-d')."</div>";
            })
            ->addColumn('type')
            ->addColumn('color')
            ->addColumn('gender')
            ->addColumn('home_breed')
            ->addColumn('notes')
            ->addColumn('inserted_by', function (Rabbit $rabbit) {
                return $rabbit->insertedByUser->name ?? '';
            })
            ->addColumn('updated_by', function (Rabbit $rabbit) {
                return $rabbit->updatedByUser->name ?? '';
            });
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
                ->title(__('TAG ID'))
                ->field('tag_id')
                ->sortable('tag_id'),

            Column::add()
                ->title(__('BREEDING ID'))
                ->field('breeding_id')
                ->sortable('breeding_id'),

            Column::add()
                ->title(__('CAGE NO'))
                ->field('cage_no')
                ->sortable('cage_no'),

            Column::add()
                ->title(__('CATEGORY'))
                ->field('c.name')
                ->sortable('c.name')
                ->searchable('c.name'),

            Column::add()
                ->title(__('BREED'))
                ->field('b.name')
                ->sortable('b.name')
                ->searchable('b.name'),

            Column::add()
                ->title(__('TYPE'))
                ->field('type')
                ->sortable('type')
                ->searchable('type'),

            Column::add()
                ->title(__('COLOR'))
                ->field('color')
                ->sortable('rabbits.color')
                ->searchable('rabbits.color'),

            Column::add()
                ->title(__('DOB'))
                ->field('dob')
                ->sortable('dob')
                ->searchable('dob'),

            Column::add()
                ->title(__('GENDER'))
                ->field('gender')
                ->sortable('gender')
                ->searchable('gender'),

            Column::add()
                ->title(__('STATUS'))
                ->field('rs.name')
                ->sortable('rs.name')
                ->searchable('rs.name'),

            Column::add()
                ->title(__('HOME BREED'))
                ->field('home_breed')
                ->sortable('home_breed'),

            Column::add()
                ->title(__('NOTES'))
                ->field('notes')
                ->sortable('notes')
                ->searchable('notes'),

            Column::add()
                ->title(__('INSERTED BY'))
                ->field('inserted_by')
                ->sortable('inserted_by'),

            Column::add()
                ->title(__('UPDATED BY'))
                ->field('updated_by')
                ->sortable('updated_by'),

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable this section only when you have defined routes for these actions.
    |
    */

    public function actions()
    : array
    {
        return [
            Button::add('edit')
                ->caption('<i class="fas fa-edit"></i>')
                ->class('btn btn-sm btn-info')
                ->route('rabbit.edit', ['rabbit' => 'id'])
                ->target(false),
        ];
    }

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
           $updated = Rabbit::query()->find($data['id'])->update([
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

    public function header(): array
    {
        return [
            Button::add('Add Rabbit')
                ->caption('New window')
                ->class('bg-gray-300')
        ];
    }
}
