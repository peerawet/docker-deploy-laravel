<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    // Disable timestamps
    public $timestamps = false;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'expense';

    /**
     * Indicates if the model's primary key ID is not incrementing.
     *
     * @var bool
     */
    protected $primaryKey = 'pv_no';

    /**
     * Indicates if the model's primary key is incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pv_no',
        'payee_id',
        'category_id',
        'pv_issue_date',
        'payment_date',
        'payment_method',
        'description_1',
        'description_2',
        'description_3',
        'description_4',
        'description_5',
        'amount_1',
        'amount_2',
        'amount_3',
        'amount_4',
        'amount_5',
        'remark',
        'prepared_by',
        'created_at',
        'edit_by',
        'edit_date',
        'bank',
        'branch',
        'bank_no'
    ];

    /**
     * Get the payee associated with the expense.
     */
    public function payee()
    {
        return $this->belongsTo(MasterFilePayee::class);
    }

    /**
     * Get the category associated with the expense.
     */
    public function category()
    {
        return $this->belongsTo(MasterFileCategory::class);
    }

    /**
     * Get the user who prepared the expense.
     */
    public function preparedBy()
    {
        return $this->belongsTo(User::class, 'prepared_by');
    }

    /**
     * Get the user who edited the expense.
     */
    public function editedBy()
    {
        return $this->belongsTo(User::class, 'edit_by');
    }
}
