<?

use App\Http\Controllers\Customer\DashboardController;
use App\Http\Controllers\QRDetailsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index']);


Route::get('qr_code_detail', [QRDetailsController::class, 'index'])->name('qr_code_details.index');

Route::get('qr_code_detail/edit/{id}', [QRDetailsController::class, 'edit'])->name('qr_code_details.edit');
Route::post('qr_code_detail/update/{id}', [QRDetailsController::class, 'update'])->name('qr_code_details.update');
Route::post('generate_qr_code/generate', [QRDetailsController::class, 'generate'])->name('generate_qr_code');
Route::post('upload_logo', [QRDetailsController::class, 'upload'])->name('upload_logo');
