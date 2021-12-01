<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breeding extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'org_id',
        'litter_no',
        'cage_no',
        'parent_doe',
        'parent_buck',
        'date_bred',
        'expected_kindle_date',
        'kindle_date',
        'weaning_date',
        'planned_rebreed_date',
        'is_rebreed',
        'born_alive',
        'born_dead',
        'total_kits',
        'born_doe',
        'born_buck',
        'notes',
        'inserted_by',
        'updated_by',
        'is_draft'
    ];

    public function idGenerator()
    {
        $year    = now()->format('y');
        $no_tags = $this->select(['id', 'litter_no', 'org_id'])
            ->where('org_id', Members::getOrgID(auth()->id()))
            ->whereNull('litter_no')
            ->get()
            ->toArray();

        $with_tags = $this->select(['id', 'litter_no'])
            ->where('org_id', Members::getOrgID(auth()->id()))
            ->where('litter_no', 'LIKE', "L-{$year}%")
            ->whereNotNull('litter_no')
            ->count();

        foreach ($no_tags as $key => $value) {
            $with_tags++;
            $hold = substr(1000000 + $with_tags, 1);
            $this->where('id', $value['id'])->update([
                'litter_no' => "L-{$year}{$value['org_id']}{$hold}",
            ]);
        }
    }

    public function sire()
    {
        return $this->hasOne(Rabbit::class, 'id', 'parent_buck');
    }

    public function dam()
    {
        return $this->hasOne(Rabbit::class, 'id', 'parent_doe');
    }

    public function litterNo($org_id)
    {
        return $this->where('org_id', $org_id)
            ->select(['id', 'litter_no'])->get();
    }

    public static function draftCleaner()
    {
        (new self)->query()
            ->where('inserted_by', auth()->user()->email)
            ->where('is_draft', 1)
            ->where('org_id', Members::getOrgID(auth()->id()))
            ->forceDelete();
    }
}
