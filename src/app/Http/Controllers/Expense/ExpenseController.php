<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;

use App\Models\MasterFilePayee;
use App\Models\MasterFileCategory;
use App\Models\MasterFileExpenseDescription;


class ExpenseController extends Controller

{
    public $title_layouts = 'Expense';

    public function index(Request $request)
    {
        // Retrieve query parameters with default values
        $sortField = $request->query('sort_field', 'pv_no');
        $sortOrder = $request->query('sort_order', 'asc');
        $searchValue = $request->query('search_value', '');
    
        // Initialize the query with the base table and joins for related fields
        $query = Expense::query()
            ->leftJoin('master_file_payee', 'expense.payee_id', '=', 'master_file_payee.id')
            ->leftJoin('master_file_categories', 'expense.category_id', '=', 'master_file_categories.id')
            ->select('expense.*', 'master_file_payee.payee as payee_name', 'master_file_categories.category as category_name');
    
        // Apply sorting
        switch ($sortField) {
            case 'pv_no':
                $query->orderBy('pv_no', $sortOrder);
                break;
            case 'payee':
                $query->orderBy('master_file_payee.payee', $sortOrder);
                break;
            case 'category':
                $query->orderBy('master_file_categories.category', $sortOrder);
                break;
            case 'pv_issue_date':
                $query->orderBy('pv_issue_date', $sortOrder);
                break;
            case 'payment_date':
                $query->orderBy('payment_date', $sortOrder);
                break;
            case 'payment_method':
                $query->orderBy('payment_method', $sortOrder);
                break;
            default:
                $query->orderBy('pv_no', 'asc');
                break;
        }
    
        // Apply search filters if searchValue is provided
        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('pv_no', 'like', '%' . $searchValue . '%')
                    ->orWhere('master_file_payee.payee', 'like', '%' . $searchValue . '%')
                    ->orWhere('master_file_categories.category', 'like', '%' . $searchValue . '%')
                    ->orWhere('pv_issue_date', 'like', '%' . $searchValue . '%')
                    ->orWhere('payment_date', 'like', '%' . $searchValue . '%')
                    ->orWhere('payment_method', 'like', '%' . $searchValue . '%');
            });
        }
    
        // Paginate the results
        $expenses = $query->paginate(50); // Adjust the number as per your pagination needs
    
        // Prepare the data array for the view
        $data = [
            'title_layouts' => $this->title_layouts,
            'expenses' => $expenses,
            'sortField' => $sortField,
            'sortOrder' => $sortOrder,
            'searchValue' => $searchValue,
        ];
    
        // Return the view with the data
        return view('front-end.pages.Expense.index', $data);
    }
    

    
    

    

    public function createUpdate(Request $request, $id = null)
    {   
    // Retrieve all Payee data
    $payees = MasterFilePayee::all();

    // Retrieve all Category data
    $categories = MasterFileCategory::all();

    // Retrieve all ExpenseDescription data
    $expenseDescriptions = MasterFileExpenseDescription::all();

    // Initialize $expense variable
    $expense = null;

    if ($id) {
        // If $id is provided in the URL, fetch the expense data
        $expense = Expense::find($id);
    }

    // Data to pass to the view
    $data = [
        'title_layouts' => $this->title_layouts,
        'payees' => $payees,
        'categories' => $categories,
        'expenseDescriptions' => $expenseDescriptions,
        'expense' => $expense, // Pass fetched expense data to the view
    ];

    // Return the view with the data
    return view('front-end.pages.Expense.form', $data);
    }




    public function expensePost(Request $request)
    {
        try {

            // Access pv_no directly from request
            $pvNo = $request->input('pv_no');

    
            // Check if the expense exists
            $expense = Expense::find($pvNo);
    
            // Prepare data to update or create
            $data = $request->only([
           
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
            ]);
    
            if ($expense) {
                // Update existing expense
                $expense->update($data);
                $message = 'Expense updated successfully.';
            } else {
                // Create new expense
                $data['pv_no'] = $pvNo; // Ensure pv_no is set in data
                $expense = Expense::create($data);
                $message = 'Expense created successfully.';
            }
    
            // Redirect back with success message
            return redirect()->route('expense.create-update', ['id' => $pvNo])->with('success', $message);
        } catch (\Exception $e) {
            // Redirect back with error message
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again. ' . $e->getMessage());
        }
    }
    
    public function delete($id)
    {
        try {
            // Find the expense by ID
            $expense = Expense::findOrFail($id);

            // Delete the expense
            $expense->delete();

            // Redirect back with success message
            return redirect()->route('expense.index')->with('success', 'Expense deleted successfully.');
        } catch (\Exception $e) {
            // Handle any exceptions, e.g., expense not found
            return redirect()->back()->with('error', 'Failed to delete expense.');
        }
    }
    
}
