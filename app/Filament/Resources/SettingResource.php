<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use UnitEnum;
use BackedEnum;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions;

class SettingResource extends Resource
{
    protected static ?string $model           = Setting::class;
    protected static string|BackedEnum|null $navigationIcon  = 'heroicon-o-cog-6-tooth';
    protected static string|UnitEnum|null   $navigationGroup = 'Administrasi';
    protected static ?string $navigationLabel = 'Pengaturan Situs';
    protected static ?int    $navigationSort  = 2;
    protected static ?string $modelLabel      = 'Pengaturan';

    public static function schema(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('key')
                ->label('Kunci Setting')
                ->required()
                ->unique(ignoreRecord: true)
                ->placeholder('Contoh: site_name, contact_phone')
                ->helperText('Gunakan huruf kecil dan underscore, tanpa spasi'),

            Select::make('group')
                ->label('Grup')
                ->options([
                    'general'    => 'Umum (General)',
                    'contact'    => 'Kontak',
                    'appearance' => 'Tampilan',
                    'seo'        => 'SEO',
                ])
                ->default('general')
                ->required(),

            Textarea::make('value')
                ->label('Nilai')
                ->rows(3)
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->label('Kunci')
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('group')
                    ->label('Grup')
                    ->badge()
                    ->color(fn(string $state): string => match($state) {
                        'general'    => 'success',
                        'contact'    => 'info',
                        'appearance' => 'warning',
                        'seo'        => 'danger',
                        default      => 'gray',
                    }),
                Tables\Columns\TextColumn::make('value')
                    ->label('Nilai')
                    ->limit(60)
                    ->placeholder('(kosong)'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('group')
                    ->label('Grup')
                    ->options([
                        'general'    => 'Umum',
                        'contact'    => 'Kontak',
                        'appearance' => 'Tampilan',
                        'seo'        => 'SEO',
                    ]),
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit'   => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
