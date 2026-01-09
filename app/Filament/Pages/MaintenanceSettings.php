<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use App\Models\Setting;
use Illuminate\Support\Str;

class MaintenanceSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';
    protected static ?string $navigationLabel = 'Maintenance Mode';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 1;
    protected static string $view = 'filament.pages.maintenance-settings';

    // Ubah jadi public properties (bukan array)
    public bool $maintenance_mode = false;
    public string $admin_bypass_token = '';
    public string $bypass_url = '';

    public function mount(): void
    {
        $maintenanceMode = Setting::get('maintenance_mode', '0');
        $adminToken = Setting::get('admin_bypass_token');

        // Generate token kalau belum ada
        if (!$adminToken) {
            $adminToken = Str::random(32);
            Setting::set('admin_bypass_token', $adminToken, 'text');
        }

        // Set property langsung
        $this->maintenance_mode = $maintenanceMode === '1';
        $this->admin_bypass_token = $adminToken;
        $this->bypass_url = url('/?admin_token=' . $adminToken);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Maintenance Mode Settings')
                    ->description('Kelola mode maintenance website')
                    ->schema([
                        Toggle::make('maintenance_mode')
                            ->label('Aktifkan Maintenance Mode')
                            ->helperText('Ketika diaktifkan, hanya admin yang bisa mengakses website')
                            ->inline(false)
                            ->live() // Tambah ini biar realtime
                            ->columnSpanFull(),

                        TextInput::make('admin_bypass_token')
                            ->label('Admin Bypass Token')
                            ->helperText('Copy token ini untuk bypass maintenance mode')
                            ->readOnly()
                            ->columnSpanFull(),

                        TextInput::make('bypass_url')
                            ->label('URL Bypass (Copy URL ini)')
                            ->readOnly()
                            ->helperText('Paste URL ini di browser untuk bypass maintenance mode')
                            ->columnSpanFull(),
                    ])
            ]);
    }

    public function save(): void
    {
        // Simpan ke database
        Setting::set('maintenance_mode', $this->maintenance_mode ? '1' : '0', 'text');
        Setting::set('admin_bypass_token', $this->admin_bypass_token, 'text');

        Notification::make()
            ->title('Pengaturan berhasil disimpan!')
            ->success()
            ->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('save')
                ->label('Simpan Pengaturan')
                ->action('save')
                ->color('primary'),
        ];
    }
}