<?

use App\Http\Controllers\DocumentTypeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\SuperAdmin\ManageAdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index']);


