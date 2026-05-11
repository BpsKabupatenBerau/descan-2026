<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TabelStatistikResource\Pages;
use App\Models\TabelStatistik;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use UnitEnum;
use BackedEnum;

use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class TabelStatistikResource extends Resource
{
    protected static ?string $model           = TabelStatistik::class;
    protected static string|BackedEnum|null $navigationIcon  = 'heroicon-o-chart-bar';
    protected static string|UnitEnum|null   $navigationGroup = 'Statistik';
    protected static ?string $navigationLabel = 'Tabel Statistik';
    protected static ?int    $navigationSort  = 1;
    protected static ?string $modelLabel      = 'Tabel Statistik';

    public static function schema(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Informasi Dasar')
                ->schema([
                    TextInput::make('judul_tabel')
                        ->label('Judul Tabel / Chart')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn($state, \Filament\Forms\Set $set) =>
                            $set('slug', Str::slug($state))
                        ),

                    TextInput::make('slug')
                        ->label('Slug (URL)')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->helperText('Otomatis terisi dari judul'),

                    Select::make('kategori_id')
                        ->label('Kategori')
                        ->relationship('kategori', 'judul_kategori')
                        ->searchable()
                        ->preload()
                        ->required(),

                    Select::make('satuan_id')
                        ->label('Satuan')
                        ->relationship('satuan', 'judul_satuan')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->createOptionForm([
                            TextInput::make('judul_satuan')
                                ->label('Satuan Baru')
                                ->required(),
                        ]),

                    TextInput::make('sumber_data')
                        ->label('Sumber Data')
                        ->placeholder('Contoh: Disdukcapil 2024'),

                    Select::make('periode_data')
                        ->label('Periode Data')
                        ->options([
                            'Tahunan'    => 'Tahunan',
                            'Bulanan'    => 'Bulanan',
                            'Triwulan'  => 'Triwulan',
                            'Semesteran' => 'Semesteran',
                        ])
                        ->default('Tahunan'),
                ])
                ->columns(2),

            Section::make('Tampilan Chart')
                ->schema([
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

                    Toggle::make('is_active')
                        ->label('Aktif')
                        ->default(true),
                ])
                ->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
                    ->label('Tipe')
                    ->badge()
                    ->color(fn(string $state): string => match($state) {
                        'bar'             => 'info',
                        'line'            => 'success',
                        'pie','doughnut'  => 'warning',
                        'number'          => 'danger',
                        default           => 'gray',
                    }),
                Tables\Columns\TextColumn::make('satuan.judul_satuan')
                    ->label('Satuan'),
                Tables\Columns\TextColumn::make('inputData_count')
                    ->label('Baris Data')
                    ->counts('inputData')
                    ->badge()
                    ->color('gray'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
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
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('input_data')
                    ->label('Input Data')
                    ->icon('heroicon-o-plus-circle')
                    ->color('success')
                    ->url(fn(TabelStatistik $record): string =>
                        InputDataTabelResource::getUrl('index').'?tableFilter='.$record->id
                    ),
                Tables\Actions\DeleteAction::make(),
            ])
            ->defaultSort('baris_tabel_ke')
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
}
