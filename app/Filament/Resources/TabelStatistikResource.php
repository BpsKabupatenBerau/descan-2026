<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TabelStatistikResource\Pages;
use App\Models\TabelStatistik;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use UnitEnum;
use BackedEnum;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions;
use Illuminate\Support\Str;

class TabelStatistikResource extends Resource
{
    protected static ?string $model           = TabelStatistik::class;
    protected static string|BackedEnum|null $navigationIcon  = 'heroicon-o-chart-bar';
    protected static string|UnitEnum|null   $navigationGroup = 'Konten';
    protected static ?string $navigationLabel = 'Statistik';
    protected static ?int    $navigationSort  = 1;
    protected static ?string $modelLabel      = 'Tabel Statistik';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([

            Grid::make(2)
                ->schema([
                    Section::make('Informasi Statistik')
                        ->schema([
                            Select::make('kategori_id')
                                ->label('Kategori')
                                ->relationship('kategori', 'judul_kategori')
                                ->searchable()
                                ->preload()
                                ->placeholder('-- Pilih Kategori --')
                                ->required()
                                ->columnSpanFull(),

                            TextInput::make('judul_tabel')
                                ->label('Judul Tabel')
                                ->placeholder('-- Pilih Tabel Statistik --')
                                ->required()
                                ->maxLength(255)
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn($state, \Filament\Forms\Set $set) =>
                                    $set('slug', Str::slug($state))
                                )
                                ->columnSpanFull(),

                            Select::make('tahun_id')
                                ->label('Periode Data')
                                ->options(fn () => \App\Models\Tahun::orderByDesc('tahun')->pluck('tahun', 'id'))
                                ->searchable()
                                ->placeholder('-- Pilih Tahun --')
                                ->dehydrated(false)
                                ->columnSpanFull(),

                            Select::make('bulan_id')
                                ->label(' ')
                                ->options(fn () => \App\Models\Bulan::orderBy('id')->pluck('nama', 'id'))
                                ->searchable()
                                ->nullable()
                                ->placeholder('-- Pilih Bulan (Apabila data terkecilnya bulan) --')
                                ->dehydrated(false)
                                ->columnSpanFull(),

                            Toggle::make('is_active')
                                ->label('Aktif')
                                ->helperText('Tampilkan di halaman publik')
                                ->default(true)
                                ->columnSpanFull(),
                        ]),

                    Section::make('Upload Excel')
                        ->schema([
                            FileUpload::make('file_excel')
                                ->label('')
                                ->acceptedFileTypes([
                                    'application/vnd.ms-excel',
                                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                ])
                                ->directory('excel-uploads')
                                ->disk('public')
                                ->maxSize(10240)
                                ->helperText('Format: XLSX - Maks 10 MB')
                                ->nullable()
                                ->columnSpanFull(),
                        ])
                        ->visible(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord),
                ]),

            Section::make('Pratinjau Tabel')
                ->schema([
                    Placeholder::make('pratinjau')
                        ->label('')
                        ->content('Tabel akan tampil di sini setelah upload')
                        ->columnSpanFull(),
                ]),

            Section::make('Pengaturan Lanjutan')
                ->collapsed()
                ->schema([
                    TextInput::make('slug')
                        ->label('Slug (URL)')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->helperText('Otomatis terisi dari judul'),

                    Select::make('satuan_id')
                        ->label('Satuan')
                        ->relationship('satuan', 'judul_satuan')
                        ->searchable()
                        ->preload()
                        ->nullable()
                        ->createOptionForm([
                            TextInput::make('judul_satuan')
                                ->label('Satuan Baru')
                                ->required(),
                        ]),

                    TextInput::make('sumber_data')
                        ->label('Sumber Data')
                        ->placeholder('Contoh: Disdukcapil 2024'),

                    Select::make('tipe_chart')
                        ->label('Tipe Chart')
                        ->options([
                            'bar'       => '📊 Bar Chart',
                            'line'      => '📈 Line Chart',
                            'pie'       => '🥧 Pie Chart',
                            'doughnut'  => '🍩 Doughnut Chart',
                            'radar'     => '🕸 Radar Chart',
                            'polarArea' => '⭕ Polar Area',
                            'number'    => '🔢 Angka / KPI',
                            'table'     => '📋 Tabel Saja',
                        ])
                        ->required()
                        ->default('bar'),

                    TextInput::make('baris_tabel_ke')
                        ->label('Urutan Tampil')
                        ->numeric()
                        ->default(0),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->searchPlaceholder('Cari judul statistik..')
            ->modifyQueryUsing(fn (\Illuminate\Database\Eloquent\Builder $query) => $query->with('inputData.tahun'))
            ->columns([
                Tables\Columns\TextColumn::make('judul_tabel')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kategori.judul_kategori')
                    ->label('Kategori')
                    ->badge()
                    ->color('success'),
                Tables\Columns\TextColumn::make('tipe_chart')
                    ->label('Tipe Chart')
                    ->badge()
                    ->color(fn(string $state): string => match($state) {
                        'bar'             => 'info',
                        'line'            => 'success',
                        'pie','doughnut'  => 'warning',
                        'number'          => 'danger',
                        default           => 'gray',
                    }),
                Tables\Columns\TextColumn::make('inputData_count')
                    ->label('Baris Data')
                    ->counts('inputData')
                    ->badge()
                    ->color('gray'),
                Tables\Columns\TextColumn::make('data_year')
                    ->label('Tahun Terkini')
                    ->placeholder('-')
                    ->sortable(),
                Tables\Columns\TextColumn::make('is_active')
                    ->label('Status')
                    ->badge()
                    ->color(fn(bool $state): string => $state ? 'success' : 'danger')
                    ->formatStateUsing(fn(bool $state): string => $state ? 'Aktif' : 'Draft'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori_id')
                    ->label('Kategori')
                    ->relationship('kategori', 'judul_kategori'),
                Tables\Filters\SelectFilter::make('tipe_chart')
                    ->label('Tipe Chart')
                    ->options(['bar'=>'Bar','line'=>'Line','pie'=>'Pie',
                               'doughnut'=>'Doughnut','number'=>'KPI']),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\Action::make('input_data')
                    ->label('Input Data')
                    ->icon('heroicon-o-plus-circle')
                    ->color('success')
                    ->url(fn(TabelStatistik $record): string =>
                        InputDataTabelResource::getUrl('index').'?tableFilter='.$record->id
                    ),
                Actions\DeleteAction::make(),
            ])
            ->defaultSort('baris_tabel_ke')
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTabelStatistik::route('/'),
            'create' => Pages\CreateTabelStatistik::route('/create'),
            'edit'   => Pages\EditTabelStatistik::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [];
    }
}
