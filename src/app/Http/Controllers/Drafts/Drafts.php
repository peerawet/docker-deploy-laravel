<?php

namespace App\Http\Controllers\Drafts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Draft;
use Carbon\Carbon;
use App\Models\MasterFileShipper;
use App\Models\MasterFileAgent;
use App\Models\MasterFileDestinationPort;
use App\Models\MasterFileTranshipmentPort;
use App\Models\MasterFileLoadingPort;
use App\Models\MasterFileContainerType;
use App\Models\MasterFileFeeder;
use App\Models\MasterFileVessel;
use App\Models\MasterFileDepot;
use App\Models\MasterFileGateInDepot;
use App\Models\MasterFileLoadingLocation;
use App\Models\MasterFileDeliveryLocation;
use App\Models\Incident;
use App\Models\TruckWaybill;
use DateTime;

class Drafts extends Controller
{
    public $title_layouts = 'Drafts';




    public function edit(Request $request)
    {
        $title_layouts = 'แก้ไข Draft';
        $data = [
            'title_layouts' => $title_layouts,
        ];
        // Fetch the user ID from the request
        $draftId = $request->draftId;



        // Fetch the draft from the database based on the draft ID
        $draft = Draft::find($draftId);

        // Check if the draft exists
        if (!$draft) {
            abort(404, 'Draft not found');
        }

        // Pass the user data to the view
        return view('front-end.pages.Drafts.formEditDraft', ['draft' => $draft], $data);
    }

    public function deleteSelectedDrafts(Request $request)
    {
        try {

            // Retrieve selected draft IDs from the request
            $selectedIds = $request->input('ids');

            // Check if $selectedIds is a string, and convert it to an array if necessary
            if (is_string($selectedIds)) {
                $selectedIds = json_decode($selectedIds, true);
            }

            // Check if $selectedIds is now an array
            if (!is_array($selectedIds)) {
                throw new \Exception('Invalid input format for selected IDs.');
            }

            // Delete selected drafts from the database
            Draft::whereIn('draft_no', $selectedIds)->delete();

            // Return a response indicating success
            return redirect()->route('drafts.index')->with("success", "Delete draft successful");
        } catch (\Exception $e) {
            // If deletion fails due to integrity constraint violation
            // Handle the failure gracefully and provide appropriate feedback to the user
            return redirect()->route('drafts.index')->with("error", "Failed to delete draft. It has associated Jobs records.");
        }
    }

    public function index(Request $request)
    {
        $sortField = $request->query('sort_field', 'draft_no');
        $sortOrder = $request->query('sort_order', 'desc');
        $searchField = $request->query('search_field', 'all');
        $searchValue = $request->query('search_value', '');
        $searchFieldNew = $request->query('search_field_new', 'all'); // New search field
        $searchValueNew = $request->query('search_value_new', ''); // New search value



        $drafts = Draft::query()
            ->select('drafts.*')
            ->with(['shipper', 'agent', 'containerType', 'depot', 'gateInDepot', 'sale', 'editedBy', 'preparedBy', 'vessel', 'feeder', 'transhipmentPort', 'loadingPort', 'destinationPort', 'loadingLocation', 'deliveryLocation'])
            ->leftJoin('master_file_container_type', 'drafts.container_type_id', '=', 'master_file_container_type.id')
            ->orderBy($sortField, $sortOrder)
            ->when($searchField && $searchValue, function ($query) use ($searchField, $searchValue) {
                $query->where(function ($query) use ($searchField, $searchValue) {
                    switch ($searchField) {
                        case 'all':
                            $query->where('draft_no', 'like', '%' . $searchValue . '%')
                                ->orWhereHas('shipper', function ($subQuery) use ($searchValue) {
                                    $subQuery->where('name', 'like', '%' . $searchValue . '%');
                                })
                                ->orWhereHas('agent', function ($subQuery) use ($searchValue) {
                                    $subQuery->where('name', 'like', '%' . $searchValue . '%');
                                })
                                ->orWhere('qty', 'like', '%' . $searchValue . '%')
                                ->orWhere('temp', 'like', '%' . $searchValue . '%')
                                ->orWhereHas('containerType', function ($subQuery) use ($searchValue) {
                                    $subQuery->where('size', 'like', '%' . $searchValue . '%');
                                })

                                ->orWhereHas('depot', function ($subQuery) use ($searchValue) {
                                    $subQuery->where('name', 'like', '%' . $searchValue . '%');
                                })
                                ->orWhereHas('gateInDepot', function ($subQuery) use ($searchValue) {
                                    $subQuery->where('name', 'like', '%' . $searchValue . '%');
                                })
                                ->orWhereHas('sale', function ($subQuery) use ($searchValue) {
                                    $subQuery->where('name', 'like', '%' . $searchValue . '%');
                                })
                                ->orWhereHas('editedBy', function ($subQuery) use ($searchValue) {
                                    $subQuery->where('name', 'like', '%' . $searchValue . '%');
                                })
                                ->orWhereHas('preparedBy', function ($subQuery) use ($searchValue) {
                                    $subQuery->where('name', 'like', '%' . $searchValue . '%');
                                })
                                ->orWhereHas('vessel', function ($subQuery) use ($searchValue) {
                                    $subQuery->where('name', 'like', '%' . $searchValue . '%');
                                })
                                ->orWhereHas('feeder', function ($subQuery) use ($searchValue) {
                                    $subQuery->where('name', 'like', '%' . $searchValue . '%');
                                })
                                ->orWhereHas('transhipmentPort', function ($subQuery) use ($searchValue) {
                                    $subQuery->where('name', 'like', '%' . $searchValue . '%');
                                })
                                ->orWhereHas('loadingPort', function ($subQuery) use ($searchValue) {
                                    $subQuery->where('name', 'like', '%' . $searchValue . '%');
                                })
                                ->orWhereHas('destinationPort', function ($subQuery) use ($searchValue) {
                                    $subQuery->where('name', 'like', '%' . $searchValue . '%');
                                })
                                ->orWhereHas('loadingLocation', function ($subQuery) use ($searchValue) {
                                    $subQuery->where('name', 'like', '%' . $searchValue . '%');
                                })
                                ->orWhereHas('deliveryLocation', function ($subQuery) use ($searchValue) {
                                    $subQuery->where('name', 'like', '%' . $searchValue . '%');
                                })
                                ->orWhere('booking_no', 'like', '%' . $searchValue . '%')
                                ->orWhere('customer_ref', 'like', '%' . $searchValue . '%')
                                ->orWhere('voy_feeder', 'like', '%' . $searchValue . '%')
                                ->orWhere('voy_vessel', 'like', '%' . $searchValue . '%')
                                ->orWhere('status', 'like', '%' . $searchValue . '%')
                                ->orWhere('remark', 'like', '%' . $searchValue . '%')
                                ->orWhere('type', 'like', '%' . $searchValue . '%')
                                ->orWhere('SI_time', 'like', '%' . $searchValue . '%')
                                ->orWhere('SI_date', 'like', '%' . $searchValue . '%')
                                ->orWhere('VGM_date', 'like', '%' . $searchValue . '%')
                                ->orWhere('VGM_time', 'like', '%' . $searchValue . '%')
                                ->orWhere('loading_time', 'like', '%' . $searchValue . '%')
                                ->orWhere('cross_border_date', 'like', '%' . $searchValue . '%')

                                ->orWhere('first_container_return_date', 'like', '%' . $searchValue . '%')
                                ->orWhere('pick_up_date', 'like', '%' . $searchValue . '%')
                                ->orWhere('drafts.edit_date', 'like', '%' . $searchValue . '%')

                                ->orWhere('drafts.edit_by', 'like', '%' . $searchValue . '%') // Specify the correct column name

                                ->orWhere('created_at', 'like', '%' . $searchValue . '%')
                                ->orWhere('prepared_by', 'like', '%' . $searchValue . '%')
                                ->orWhere('draft_date', 'like', '%' . $searchValue . '%')
                                ->orWhere('closing_time', 'like', '%' . $searchValue . '%')
                                ->orWhere('closing_date', 'like', '%' . $searchValue . '%')
                                ->orWhere('ETA_date', 'like', '%' . $searchValue . '%')
                                ->orWhere('ETD_date', 'like', '%' . $searchValue . '%')
                                ->orWhere('return_date', 'like', '%' . $searchValue . '%')
                                ->orWhere('loading_date', 'like', '%' . $searchValue . '%')
                                ->orWhere('customer_ref', 'like', '%' . $searchValue . '%')
                                ->orWhere('booking_no', 'like', '%' . $searchValue . '%')
                                // Combine `qty`, `size` and `temp` into a single search field
                                ->orWhere(DB::raw("CONCAT(drafts.qty, ' X ', master_file_container_type.size, ' X ', drafts.temp)"), 'like', '%' . $searchValue . '%');
                            break;
                        case 'shipper_name':
                            $query->whereHas('shipper', function ($subQuery) use ($searchValue) {
                                $subQuery->where('name', 'like', '%' . $searchValue . '%');
                            });
                            break;
                        case 'agent_name':
                            $query->whereHas('agent', function ($subQuery) use ($searchValue) {
                                $subQuery->where('name', 'like', '%' . $searchValue . '%');
                            });
                            break;
                        case 'container_type_id':
                            $query->where(function ($subQuery) use ($searchValue) {
                                $subQuery->where('qty', 'like', '%' . $searchValue . '%')
                                    ->orWhere('temp', 'like', '%' . $searchValue . '%')
                                    ->orWhereHas('containerType', function ($subSubQuery) use ($searchValue) {
                                        $subSubQuery->where('size', 'like', '%' . $searchValue . '%');
                                    });
                            });
                            break;
                        case 'depot_name':
                            $query->whereHas('depot', function ($subQuery) use ($searchValue) {
                                $subQuery->where('name', 'like', '%' . $searchValue . '%');
                            });
                            break;
                        case 'gate_in_depot_name':
                            $query->whereHas('gateInDepot', function ($subQuery) use ($searchValue) {
                                $subQuery->where('name', 'like', '%' . $searchValue . '%');
                            });
                            break;
                        case 'sale_name':
                            $query->whereHas('sale', function ($subQuery) use ($searchValue) {
                                $subQuery->where('name', 'like', '%' . $searchValue . '%');
                            });
                            break;
                        case 'edit_by':
                            $query->whereHas('editedBy', function ($subQuery) use ($searchValue) {
                                $subQuery->where('name', 'like', '%' . $searchValue . '%');
                            });
                            break;
                        case 'prepared_by':
                            $query->whereHas('preparedBy', function ($subQuery) use ($searchValue) {
                                $subQuery->where('name', 'like', '%' . $searchValue . '%');
                            });
                            break;
                        case 'vessel':
                            $query->whereHas('vessel', function ($subQuery) use ($searchValue) {
                                $subQuery->where('name', 'like', '%' . $searchValue . '%');
                            });
                            break;
                        case 'feeder':
                            $query->whereHas('feeder', function ($subQuery) use ($searchValue) {
                                $subQuery->where('name', 'like', '%' . $searchValue . '%');
                            });
                            break;
                        case 'transhipment_port':
                            $query->whereHas('transhipmentPort', function ($subQuery) use ($searchValue) {
                                $subQuery->where('name', 'like', '%' . $searchValue . '%');
                            });
                            break;
                        case 'loading_port':
                            $query->whereHas('loadingPort', function ($subQuery) use ($searchValue) {
                                $subQuery->where('name', 'like', '%' . $searchValue . '%');
                            });
                            break;
                        case 'destination_port':
                            $query->whereHas('destinationPort', function ($subQuery) use ($searchValue) {
                                $subQuery->where('name', 'like', '%' . $searchValue . '%');
                            });
                            break;
                        case 'loading_location':
                            $query->whereHas('loadingLocation', function ($subQuery) use ($searchValue) {
                                $subQuery->where('name', 'like', '%' . $searchValue . '%');
                            });
                            break;
                        case 'delivery_location':
                            $query->whereHas('deliveryLocation', function ($subQuery) use ($searchValue) {
                                $subQuery->where('name', 'like', '%' . $searchValue . '%');
                            });
                            break;
                        default:
                            $query->where($searchField, 'like', '%' . $searchValue . '%');
                            break;
                    }
                });
            })
            ->when($searchFieldNew && $searchValueNew, function ($query) use ($searchFieldNew, $searchValueNew) {
                $query->where(function ($query) use ($searchFieldNew, $searchValueNew) {
                    switch ($searchFieldNew) {
                        case 'all':
                            $query->where('draft_no', 'like', '%' . $searchValueNew . '%')
                                ->orWhereHas('shipper', function ($subQuery) use ($searchValueNew) {
                                    $subQuery->where('name', 'like', '%' . $searchValueNew . '%');
                                })
                                ->orWhereHas('agent', function ($subQuery) use ($searchValueNew) {
                                    $subQuery->where('name', 'like', '%' . $searchValueNew . '%');
                                })
                                ->orWhere('qty', 'like', '%' . $searchValueNew . '%')
                                ->orWhere('temp', 'like', '%' . $searchValueNew . '%')
                                ->orWhereHas('containerType', function ($subQuery) use ($searchValueNew) {
                                    $subQuery->where('size', 'like', '%' . $searchValueNew . '%');
                                })
                                ->orWhereHas('depot', function ($subQuery) use ($searchValueNew) {
                                    $subQuery->where('name', 'like', '%' . $searchValueNew . '%');
                                })
                                ->orWhereHas('gateInDepot', function ($subQuery) use ($searchValueNew) {
                                    $subQuery->where('name', 'like', '%' . $searchValueNew . '%');
                                })
                                ->orWhereHas('sale', function ($subQuery) use ($searchValueNew) {
                                    $subQuery->where('name', 'like', '%' . $searchValueNew . '%');
                                })
                                ->orWhereHas('editedBy', function ($subQuery) use ($searchValueNew) {
                                    $subQuery->where('name', 'like', '%' . $searchValueNew . '%');
                                })
                                ->orWhereHas('preparedBy', function ($subQuery) use ($searchValueNew) {
                                    $subQuery->where('name', 'like', '%' . $searchValueNew . '%');
                                })
                                ->orWhereHas('vessel', function ($subQuery) use ($searchValueNew) {
                                    $subQuery->where('name', 'like', '%' . $searchValueNew . '%');
                                })
                                ->orWhereHas('feeder', function ($subQuery) use ($searchValueNew) {
                                    $subQuery->where('name', 'like', '%' . $searchValueNew . '%');
                                })
                                ->orWhereHas('transhipmentPort', function ($subQuery) use ($searchValueNew) {
                                    $subQuery->where('name', 'like', '%' . $searchValueNew . '%');
                                })
                                ->orWhereHas('loadingPort', function ($subQuery) use ($searchValueNew) {
                                    $subQuery->where('name', 'like', '%' . $searchValueNew . '%');
                                })
                                ->orWhereHas('destinationPort', function ($subQuery) use ($searchValueNew) {
                                    $subQuery->where('name', 'like', '%' . $searchValueNew . '%');
                                })
                                ->orWhereHas('loadingLocation', function ($subQuery) use ($searchValueNew) {
                                    $subQuery->where('name', 'like', '%' . $searchValueNew . '%');
                                })
                                ->orWhereHas('deliveryLocation', function ($subQuery) use ($searchValueNew) {
                                    $subQuery->where('name', 'like', '%' . $searchValueNew . '%');
                                })
                                ->orWhere('booking_no', 'like', '%' . $searchValueNew . '%')
                                ->orWhere('customer_ref', 'like', '%' . $searchValueNew . '%')
                                ->orWhere('voy_feeder', 'like', '%' . $searchValueNew . '%')
                                ->orWhere('voy_vessel', 'like', '%' . $searchValueNew . '%')
                                ->orWhere('status', 'like', '%' . $searchValueNew . '%')
                                ->orWhere('remark', 'like', '%' . $searchValueNew . '%')
                                ->orWhere('type', 'like', '%' . $searchValueNew . '%')
                                ->orWhere('SI_time', 'like', '%' . $searchValueNew . '%')
                                ->orWhere('SI_date', 'like', '%' . $searchValueNew . '%')
                                ->orWhere('VGM_date', 'like', '%' . $searchValueNew . '%')
                                ->orWhere('VGM_time', 'like', '%' . $searchValueNew . '%')
                                ->orWhere('loading_time', 'like', '%' . $searchValueNew . '%')
                                ->orWhere('cross_border_date', 'like', '%' . $searchValueNew . '%')

                                ->orWhere('first_container_return_date', 'like', '%' . $searchValueNew . '%')
                                ->orWhere('pick_up_date', 'like', '%' . $searchValueNew . '%')
                                ->orWhere('drafts.edit_date', 'like', '%' . $searchValueNew . '%')
                                ->orWhere('drafts.edit_date', 'like', '%' . $searchValueNew . '%')
                                ->orWhere('created_at', 'like', '%' . $searchValueNew . '%')
                                ->orWhere('prepared_by', 'like', '%' . $searchValueNew . '%')
                                ->orWhere('draft_date', 'like', '%' . $searchValueNew . '%')
                                ->orWhere('closing_time', 'like', '%' . $searchValueNew . '%')
                                ->orWhere('closing_date', 'like', '%' . $searchValueNew . '%')
                                ->orWhere('ETA_date', 'like', '%' . $searchValueNew . '%')
                                ->orWhere('ETD_date', 'like', '%' . $searchValueNew . '%')
                                ->orWhere('return_date', 'like', '%' . $searchValueNew . '%')
                                ->orWhere('loading_date', 'like', '%' . $searchValueNew . '%')
                                ->orWhere('customer_ref', 'like', '%' . $searchValueNew . '%')
                                ->orWhere('booking_no', 'like', '%' . $searchValueNew . '%')
                                // Combine `qty`, `size` and `temp` into a single search field
                                ->orWhere(DB::raw("CONCAT(drafts.qty, ' X ', master_file_container_type.size, ' X ', drafts.temp)"), 'like', '%' . $searchValueNew . '%');
                            break;
                        case 'shipper_name':
                            $query->whereHas('shipper', function ($subQuery) use ($searchValueNew) {
                                $subQuery->where('name', 'like', '%' . $searchValueNew . '%');
                            });
                            break;
                        case 'agent_name':
                            $query->whereHas('agent', function ($subQuery) use ($searchValueNew) {
                                $subQuery->where('name', 'like', '%' . $searchValueNew . '%');
                            });
                            break;
                        case 'container_type_id':
                            $query->where(function ($subQuery) use ($searchValueNew) {
                                $subQuery->where('qty', 'like', '%' . $searchValueNew . '%')
                                    ->orWhere('temp', 'like', '%' . $searchValueNew . '%')
                                    ->orWhereHas('containerType', function ($subSubQuery) use ($searchValueNew) {
                                        $subSubQuery->where('size', 'like', '%' . $searchValueNew . '%');
                                    });
                            });
                            break;
                        case 'depot_name':
                            $query->whereHas('depot', function ($subQuery) use ($searchValueNew) {
                                $subQuery->where('name', 'like', '%' . $searchValueNew . '%');
                            });
                            break;
                        case 'gate_in_depot_name':
                            $query->whereHas('gateInDepot', function ($subQuery) use ($searchValueNew) {
                                $subQuery->where('name', 'like', '%' . $searchValueNew . '%');
                            });
                            break;
                        case 'sale_name':
                            $query->whereHas('sale', function ($subQuery) use ($searchValueNew) {
                                $subQuery->where('name', 'like', '%' . $searchValueNew . '%');
                            });
                            break;
                        case 'edit_by':
                            $query->whereHas('editedBy', function ($subQuery) use ($searchValueNew) {
                                $subQuery->where('name', 'like', '%' . $searchValueNew . '%');
                            });
                            break;
                        case 'prepared_by':
                            $query->whereHas('preparedBy', function ($subQuery) use ($searchValueNew) {
                                $subQuery->where('name', 'like', '%' . $searchValueNew . '%');
                            });
                            break;
                        case 'vessel':
                            $query->whereHas('vessel', function ($subQuery) use ($searchValueNew) {
                                $subQuery->where('name', 'like', '%' . $searchValueNew . '%');
                            });
                            break;
                        case 'feeder':
                            $query->whereHas('feeder', function ($subQuery) use ($searchValueNew) {
                                $subQuery->where('name', 'like', '%' . $searchValueNew . '%');
                            });
                            break;
                        case 'transhipment_port':
                            $query->whereHas('transhipmentPort', function ($subQuery) use ($searchValueNew) {
                                $subQuery->where('name', 'like', '%' . $searchValueNew . '%');
                            });
                            break;
                        case 'loading_port':
                            $query->whereHas('loadingPort', function ($subQuery) use ($searchValueNew) {
                                $subQuery->where('name', 'like', '%' . $searchValueNew . '%');
                            });
                            break;
                        case 'destination_port':
                            $query->whereHas('destinationPort', function ($subQuery) use ($searchValueNew) {
                                $subQuery->where('name', 'like', '%' . $searchValueNew . '%');
                            });
                            break;
                        case 'loading_location':
                            $query->whereHas('loadingLocation', function ($subQuery) use ($searchValueNew) {
                                $subQuery->where('name', 'like', '%' . $searchValueNew . '%');
                            });
                            break;
                        case 'delivery_location':
                            $query->whereHas('deliveryLocation', function ($subQuery) use ($searchValueNew) {
                                $subQuery->where('name', 'like', '%' . $searchValueNew . '%');
                            });
                            break;
                        default:
                            $query->where($searchFieldNew, 'like', '%' . $searchValueNew . '%');
                            break;
                    }
                });
            })

            ->paginate(50)
            ->appends([
                'sort_field' => $sortField,
                'sort_order' => $sortOrder,
                'search_field' => $searchField,
                'search_value' => $searchValue,
                'search_field_new' => $searchFieldNew, // Append the new search field
                'search_value_new' => $searchValueNew // Append the new search value
            ]);

        $data = [
            'title_layouts' => $this->title_layouts,
        ];

        return view('front-end.pages.Drafts.index', compact('drafts', 'sortField', 'sortOrder', 'searchField', 'searchValue', 'searchFieldNew', 'searchValueNew'), $data);
    }



    public function print($draftId)
    {
        // Retrieve the draft with the given ID
        $draft = Draft::findOrFail($draftId);

        // Initialize the data array
        $data = [];

        // Determine the view based on the draft type
        $viewName = '';
        switch ($draft->type) {
            case 'Sea':
                $viewName = 'front-end.pages.Drafts.pdfSea';
                $data = [
                    'title_layouts' => "Preview Draft By Sea",
                ];
                break;
            case 'Truck':
                $viewName = 'front-end.pages.Drafts.pdfTruck';
                $data = [
                    'title_layouts' => "Preview Draft By Truck",
                ];
                break;
            case 'Air':
                $viewName = 'front-end.pages.Drafts.pdfAir';
                $data = [
                    'title_layouts' => "Preview Draft By Air",
                ];
                break;
            default:
                $viewName = 'front-end.pages.Drafts.pdfSea';
                $data = [
                    'title_layouts' => "Preview Draft",
                ];
                break;
        }

        // Return the appropriate view
        return view($viewName, ['draft' => $draft], $data);
    }




    public function create($draftId = null)
    {

        $draft = null;

        if ($draftId) {


            $draft = Draft::find($draftId);


            if (!$draft) {
                return redirect()->route('drafts.index')->with('error', 'Draft not found');
            }
        }

        $data = [
            'title_layouts' => 'สร้าง Draft',
            'draft' => $draft
        ];

        return view('front-end.pages.Drafts.form', $data);
    }

    public function truck_waybill_index(Request $request)
{
    // Retrieve query parameters with default values
    $sortField = $request->query('sort_field', 'invoice_no');
    $sortOrder = $request->query('sort_order', 'asc');
    $searchValue = $request->query('search_value', '');

    // Initialize the query with the base table and joins for related fields
    $query = TruckWaybill::query();

    // Apply sorting
    switch ($sortField) {
        case 'truck_waybill_no':
            $query->orderBy('truck_waybill_no', $sortOrder);
            break;
        case 'date_of_receipt':
            $query->orderBy('date_of_receipt', $sortOrder);
            break;
        case 'consignor_shipper':
            $query->orderBy('consignor_shipper', $sortOrder);
            break;
        case 'place_of_loading':
            $query->orderBy('place_of_loading', $sortOrder);
            break;
        case 'consignee':
            $query->orderBy('consignee', $sortOrder);
            break;
        case 'final_destination':
            $query->orderBy('final_destination', $sortOrder);
            break;
        default:
            $query->orderBy('invoice_no', 'asc');
            break;
    }

    // Apply search filters if searchValue is provided
    if ($searchValue) {
        $query->where(function ($query) use ($searchValue) {
            $query->where('invoice_no', 'like', '%' . $searchValue . '%')
                  ->orWhere('truck_waybill_no', 'like', '%' . $searchValue . '%')
                  ->orWhere('date_of_receipt', 'like', '%' . $searchValue . '%')
                  ->orWhere('consignor_shipper', 'like', '%' . $searchValue . '%')
                  ->orWhere('place_of_loading', 'like', '%' . $searchValue . '%')
                  ->orWhere('consignee', 'like', '%' . $searchValue . '%')
                  ->orWhere('final_destination', 'like', '%' . $searchValue . '%');
        });
    }

    // Paginate the results
    $truckWaybills = $query->paginate(50);

    // Prepare the data array for the view
    $data = [
        'title_layouts' => 'รายการ Truck Waybill',
        'truckWaybills' => $truckWaybills,
        'sortField' => $sortField,
        'sortOrder' => $sortOrder,
        'searchValue' => $searchValue,
    ];

    // Return the view with the data
    return view('front-end.pages.Drafts.truck_waybill_index', $data);
}

    

    public function truck_waybill()
    {

        // Fetch all truck waybills
        $truckWaybills = TruckWaybill::all();

        return view('front-end.pages.Drafts.truck_waybill', [
            'title_layouts' => 'Truck Waybill',
            'truckWaybills' => $truckWaybills,
        ]);
    }

    public function truck_waybill_post(Request $request)
    {

        // Validate the request data for invoice_no
        $validatedData = $request->validate([
            'invoice_no' => 'required|string|max:255',
        ]);
  

        try {
            // Check if the truck waybill exists
            $truckWaybill = TruckWaybill::where('invoice_no', $validatedData['invoice_no'])->first();


            $data = $request->only([
                'consignor_shipper',
                'consignee',
                'truck_waybill_no',
                'notify_party',
                'mto_name_address',
                'invoice_no',
                'place_of_loading',
                'date_of_receipt',
                'place_of_discharge',
                'final_destination',
                'marks_and_no',
                'no_of_packages',
                'description_of_goods',
                'gross_net_weight',
                'measurements',
                'container_no',
                'seal_no',
                'freight_details',
                'freight_payable_at',
                'place_date_of_issue',
                'no_of_copies',
                'created_at',
                'edit_by',
                'edit_date',
                'truck_no',
            ]);

            if ($truckWaybill) {
                // Update existing truck waybill
                $truckWaybill->update($data);
                $message = 'Truck waybill updated successfully.';
            } else {
                // Create new truck waybill
                $truckWaybill = TruckWaybill::create($data);
                $message = 'Truck waybill created successfully.';
            }

            // Redirect back with success message
            return redirect()->route('drafts.truckWaybill', ['id' => $validatedData['invoice_no']])->with('success', $message);
        } catch (\Exception $e) {
            // Redirect back with error message
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again.' . $e->getMessage());
        }
    }



    public function accident_report($draftId = null)
    {
        $drafts = Draft::all();
        $selectedDraft = null;

        if ($draftId) {
            $selectedDraft = Draft::find($draftId);
        }

            return view('front-end.pages.Drafts.accident_report', [
            'title_layouts' => 'Incident Report',
            'drafts' => $drafts,
            'selectedDraft' => $selectedDraft,
        ]);
    }


    public function accidentReportPost(Request $request, $draftId = null)
    {
        // dd($request);

        // Find the draft
        $draft = Draft::findOrFail($draftId);

        // Find or create the incident associated with the draft
        $incident = $draft->incident ?? new Incident();

        // Assign request data to the incident report attributes
        $incident->content = $request->input('content');
        $incident->date = $request->input('date');
        $incident->edit_by = auth()->user()->name;
        $incident->edit_date = now();
        $incident->bottom = $request->input('bottom');

        // Save the incident report first to get the ID
        $incident->save();

        // Handle file uploads, deletions, and positions
        for ($i = 1; $i <= 3; $i++) {
            $incident->{'image_' . $i . '_x'} = $request->input('image_x_' . $i);
            $incident->{'image_' . $i . '_y'} = $request->input('image_y_' . $i);
            if ($request->hasFile('img_' . $i)) {
                // File upload logic
                $file = $request->file('img_' . $i);
                // Define the destination path
                $destinationPath = 'uploads/incidents/' . $incident->id;
                // Generate a unique file name
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                // Move the file to the destination path
                $file->move(public_path($destinationPath), $fileName);
                // Save the file path in the database
                $incident->{'image_' . $i} = $destinationPath . '/' . $fileName;
            } elseif ($request->input('deleteImage_' . $i) == '1') {
                // File deletion logic
                $incident->{'image_' . $i} = null;
                // Reset the image position when deleting
                $incident->{'image_' . $i . '_x'} = null;
                $incident->{'image_' . $i . '_y'} = null;
            }
        }

        // Save the incident report with updated file paths and positions
        $incident->save();

        // Associate the incident with the draft
        $draft->incident_id = $incident->id;
        $draft->save();

        // Redirect the user to the appropriate route
        return redirect()->route('drafts.report.accident', $draft->draft_no)->with('success', 'Incident report saved successfully.');
    }








    public function draftPost(Request $request, $draftId = null)
    {
        try {

    
                    // Retrieve the last draft number from the database
      // Generate the next draft number
        $lastDraft = Draft::orderBy('draft_no', 'desc')->first();
        $nextDraftNo = $lastDraft ? str_pad(intval($lastDraft->draft_no) + 1, 6, '0', STR_PAD_LEFT) : '000001';
        // dd($nextDraftNo);



            // Handle shipper information
            $shipperName = $request->input('shipper_name');
            $shipperId = $request->input('shipper_id');

            if ($shipperName) {
                // Check if shipper already exists
                $existingShipper = MasterFileShipper::where('name', $shipperName)->first();
                if ($existingShipper) {
                    $shipperId = $existingShipper->id;
                } else {
                    // Create new shipper
                    $newShipper = MasterFileShipper::create([
                        'name' => $shipperName,
                        'contact' => '', // Optionally retrieve from request if available
                        'tel' => '',
                        'address' => '',
                        'edit_by' => Auth::user()->id,
                    ]);
                    $shipperId = $newShipper->id;
                }
            }

            // Handle agent information
            $agentName = $request->input('agent_name');
            $agentId = $request->input('agent_id');

            if ($agentName) {
                // Check if agent already exists
                $existingAgent = MasterFileAgent::where('name', $agentName)->first();
                if ($existingAgent) {
                    $agentId = $existingAgent->id;
                } else {
                    // Create new agent
                    $newAgent = MasterFileAgent::create([
                        'name' => $agentName,
                        'contact' => '', // Optionally retrieve from request if available
                        'tel' => '',
                        'edit_by' => Auth::user()->name,
                    ]);
                    $agentId = $newAgent->id;
                }
            }

            // Handle port of destination information
            $destinationPortName = $request->input('destination_port_name');
            $destinationPortId = $request->input('destination_port_id');

            if ($destinationPortName) {
                // Check if port already exists
                $existingPort = MasterFileDestinationPort::where('name', $destinationPortName)->first();
                if ($existingPort) {
                    $destinationPortId = $existingPort->id;
                } else {
                    // Create new port
                    $newPort = MasterFileDestinationPort::create([
                        'name' => $destinationPortName,
                        'edit_by' => Auth::user()->name,
                    ]);
                    $destinationPortId = $newPort->id;
                }
            }

            // Handle transhipment port information
            $transhipmentPortName = $request->input('transhipment_port_name');
            $transhipmentPortId = $request->input('transhipment_port_id');

            if ($transhipmentPortName) {
                // Check if port already exists
                $existingPort = MasterFileTranshipmentPort::where('name', $transhipmentPortName)->first();
                if ($existingPort) {
                    $transhipmentPortId = $existingPort->id;
                } else {
                    // Create new port
                    $newPort = MasterFileTranshipmentPort::create([
                        'name' => $transhipmentPortName,
                        'edit_by' => Auth::user()->name,
                    ]);
                    $transhipmentPortId = $newPort->id;
                }
            }

            $loadingPortName = $request->input('loading_port_name');
            $loadingPortId = $request->input('loading_port_id');

            if ($loadingPortName) {
                // Check if port already exists
                $existingPort = MasterFileLoadingPort::where('name', $loadingPortName)->first();
                if ($existingPort) {
                    $loadingPortId = $existingPort->id;
                } else {
                    // Create new port
                    $newPort = MasterFileLoadingPort::create([
                        'name' => $loadingPortName,
                        'edit_by' => Auth::user()->name,
                    ]);
                    $loadingPortId = $newPort->id;
                }
            }

            $containerTypeName = $request->input('container_type_name');
            $containerTypeId = $request->input('container_type_id');

            if ($containerTypeName) {
                // Check if container type already exists
                $existingContainerType = MasterFileContainerType::where('size', $containerTypeName)->first();
                if ($existingContainerType) {
                    $containerTypeId = $existingContainerType->id;
                } else {
                    // Create new container type
                    $newContainerType = MasterFileContainerType::create([
                        'size' => $containerTypeName,
                        'edit_by' => Auth::user()->name,
                    ]);
                    $containerTypeId = $newContainerType->id;
                }
            }

            $feederName = $request->input('feeder_name');
            $feederId = $request->input('feeder_id');

            if ($feederName) {
                // Check if feeder already exists
                $existingFeeder = MasterFileFeeder::where('name', $feederName)->first();
                if ($existingFeeder) {
                    $feederId = $existingFeeder->id;
                } else {
                    // Create new feeder
                    $newFeeder = MasterFileFeeder::create([
                        'name' => $feederName,
                        'edit_by' => Auth::user()->name,
                    ]);
                    $feederId = $newFeeder->id;
                }
            }
            $vesselName = $request->input('vessel_name');
            $vesselId = $request->input('vessel_id');

            if ($vesselName) {
                // Check if vessel already exists
                $existingVessel = MasterFileVessel::where('name', $vesselName)->first();
                if ($existingVessel) {
                    $vesselId = $existingVessel->id;
                } else {
                    // Create new vessel
                    $newVessel = MasterFileVessel::create([
                        'name' => $vesselName,
                        'edit_by' => Auth::user()->name,
                    ]);
                    $vesselId = $newVessel->id;
                }
            }

            // Retrieve depot name and ID from the request
            $depotName = $request->input('depot_name');
            $depotId = $request->input('depot_id');

            // Check if depot name is provided
            if ($depotName) {
                // Check if the depot already exists
                $existingDepot = MasterFileDepot::where('name', $depotName)->first();

                if ($existingDepot) {
                    // If depot exists, set its ID
                    $depotId = $existingDepot->id;
                } else {
                    // If depot doesn't exist, create a new one
                    $newDepot = MasterFileDepot::create([
                        'name' => $depotName,
                        'edit_by' => Auth::user()->name,
                        // You might need to add more fields here based on your database structure
                    ]);

                    // Set the ID of the newly created depot
                    $depotId = $newDepot->id;
                }
            }

            // Retrieve gate in depot name and ID from the request
            $gateInDepotName = $request->input('gate_in_depot_name');
            $gateInDepotId = $request->input('gate_in_depot_id');

            // Check if gate in depot name is provided
            if ($gateInDepotName) {
                // Check if the gate in depot already exists
                $existingGateInDepot = MasterFileGateInDepot::where('name', $gateInDepotName)->first();

                if ($existingGateInDepot) {
                    // If gate in depot exists, set its ID
                    $gateInDepotId = $existingGateInDepot->id;
                } else {
                    // If gate in depot doesn't exist, create a new one
                    $newGateInDepot = MasterFileGateInDepot::create([
                        'name' => $gateInDepotName,
                        'edit_by' => Auth::user()->name,
                        // You might need to add more fields here based on your database structure
                    ]);

                    // Set the ID of the newly created gate in depot
                    $gateInDepotId = $newGateInDepot->id;
                }
            }

            // Retrieve loading location name and ID from the request
            $loadingLocationName = $request->input('loading_location_name');
            $loadingLocationId = $request->input('loading_location_id');

            // Check if loading location name is provided
            if ($loadingLocationName) {
                // Check if the loading location already exists
                $existingLoadingLocation = MasterFileLoadingLocation::where('name', $loadingLocationName)->first();

                if ($existingLoadingLocation) {
                    // If loading location exists, set its ID
                    $loadingLocationId = $existingLoadingLocation->id;
                } else {
                    // If loading location doesn't exist, create a new one
                    $newLoadingLocation = MasterFileLoadingLocation::create([
                        'name' => $loadingLocationName,
                        'edit_by' => Auth::user()->name,
                        // You might need to add more fields here based on your database structure
                    ]);

                    // Set the ID of the newly created loading location
                    $loadingLocationId = $newLoadingLocation->id;
                }
            }

            // Retrieve delivery location name and ID from the request
            $deliveryLocationName = $request->input('delivery_location_name');
            $deliveryLocationId = $request->input('delivery_location_id');

            // Check if delivery location name is provided
            if ($deliveryLocationName) {
                // Check if the delivery location already exists
                $existingDeliveryLocation = MasterFileDeliveryLocation::where('name', $deliveryLocationName)->first();

                if ($existingDeliveryLocation) {
                    // If delivery location exists, set its ID
                    $deliveryLocationId = $existingDeliveryLocation->id;
                } else {
                    // If delivery location doesn't exist, create a new one
                    $newDeliveryLocation = MasterFileDeliveryLocation::create([
                        'name' => $deliveryLocationName,
                        'edit_by' => Auth::user()->name,
                        // You might need to add more fields here based on your database structure
                    ]);

                    // Set the ID of the newly created delivery location
                    $deliveryLocationId = $newDeliveryLocation->id;
                }
            }


        // Prepare draft data
        $data = $request->only([
            'draft_no',
            'booking_no',
            'customer_ref',
            'agent_id',
            'container_type_id',
            'loading_date',
            'feeder_id',
            'voy_feeder',
            'return_date',
            'vessel_id',
            'voy_vessel',
            'ETD_date',
            'ETA_date',
            'closing_date',
            'closing_time',
            'depot_id',
            'gate_in_depot_id',
            'status',
            'draft_date',
            'sale_id',
            'remark',
            'pick_up_date',
            'first_container_return_date',
            'transhipment_port_id',
            'loading_port_id',
            'destination_port_id',
            'temp',
            'qty',
            'SI_time',
            'SI_date',
            'VGM_date',
            'VGM_time',
            'container_type_name',
            'container_type_id',
            'feeder_name',
            'feeder_id',
            'type',
            'loading_time',
            'loading_location_id',
            'cross_border_date',
            'delivery_location_id'
        ]);

        $data['draft_no'] = $nextDraftNo;

        // Set additional fields
        $data['shipper_id'] = $shipperId;
        $data['agent_id'] = $agentId;
        $data['destination_port_id'] = $destinationPortId;
        $data['transhipment_port_id'] = $transhipmentPortId;
        $data['loading_port_id'] = $loadingPortId;
        $data['container_type_id'] = $containerTypeId;
        $data['feeder_id'] = $feederId;
        $data['vessel_id'] = $vesselId;
        $data['depot_id'] = $depotId;
        $data['gate_in_depot_id'] = $gateInDepotId;
        $data['loading_location_id'] = $loadingLocationId;
        $data['delivery_location_id'] = $deliveryLocationId;

        // Check if a draft with the provided $draftId exists
        // $draftId = $request->input('draftId');
        $redirectDraft = '';
        if ($draftId) {
            // If a draft with $draftId exists, update it
            $draft = Draft::find($draftId);
            if (!$draft) {
                return redirect()->route('drafts.index')->with('error', 'Draft not found');
            }

            // Add 'edit_date' and 'edit_by' fields for update
            $data['edit_date'] = Carbon::now();
            $data['edit_by'] = Auth::user()->id;

            // Remove 'prepared_by' field for update
            unset($data['prepared_by']);
            unset($data['draft_no']); // Do not update draft_no

            $draft->update($data);
            $redirectDraft = $draft->draft_no;
        } else {
            // Set the prepared_by field for new draft
            $data['prepared_by'] = Auth::user()->id;

            // Remove 'edit_date' and 'edit_by' fields for create
            unset($data['edit_date']);
            unset($data['edit_by']);
            // dd($data);

            // If $draftId is not provided, create a new draft
            $draft = Draft::create($data);
            $redirectDraft =  $nextDraftNo;

        
        }

        // Check if the draft was successfully created
        if (!$draft) {
            return redirect()->route('drafts.create')->with("error", "Failed to create draft");
        }

        // Determine the tab based on the draft type
        $tab = '';
        switch ($draft->type) {
            case 'Sea':
                $tab = 'Sea';
                break;
            case 'Truck':
                $tab = 'Truck';
                break;
            case 'Air':
                $tab = 'Air';
                break;
        }

        // Redirect to the PDF route with the created draft_no
        return redirect()->route('drafts.edit', ['draftId' => $redirectDraft, 'tab' => $tab])
            ->with("success", $draftId ? "Draft updated successfully" : "Draft created successfully");
        } catch (\Exception $e) {
        // Log the exception for debugging purposes
        logger()->error("Failed to create draft: " . $e->getMessage());

        // Redirect back to the form with a more informative error message
        return redirect()->back()->withInput()->with("error", "Failed to create draft. Please try again. " . $e->getMessage());
        }
    }





    public function checkBooking(Request $request)
    {
        $bookingNo = $request->input('booking_no');

        // Perform the check to see if the booking number exists in the database
        $bookingExists = Draft::where('booking_no', $bookingNo)->exists();

        return response()->json(['exists' => $bookingExists]);
    }

    public function checkCustomerRef(Request $request)
    {
        // Retrieve the customer reference from the request
        $customerRef = $request->input('customer_ref');

        // Check if the customer reference exists in the database
        $exists = Draft::where('customer_ref', $customerRef)->exists();

        // Return JSON response indicating existence
        return response()->json(['exists' => $exists]);
    }





    public function draftDeletePost($draftId)
    {
        // Find the draft by ID
        $draft = Draft::find($draftId);

        // Check if the draft exists
        if (!$draft) {
            return response()->json(['message' => 'Draft not found'], 404);
        }

        try {
            // Attempt to delete the draft
            $draft->delete();

            // If deletion is successful, redirect with success message
            return redirect()->route('drafts.index')->with("success", "Delete draft successful");
        } catch (\Exception $e) {
            // If deletion fails due to integrity constraint violation
            // Handle the failure gracefully and provide appropriate feedback to the user
            return redirect()->route('drafts.index')->with("error", "Failed to delete draft. It has associated Jobs records.");
        }
    }
}