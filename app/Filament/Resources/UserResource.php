<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use UnitEnum;
use BackedEnum;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model                  = User::class;
    protected static string|BackedEnum|null $navigationIcon  = 'heroicon-o-users';
    protected static string|UnitEnum|null   $navigationGroup = 'Administrasi';
    protected static ?string $navigationLabel        = 'Manajemen User';
    protected static ?int    $navigationSort         = 1;
    protected static ?string $modelLabel             = 'Pengguna';

    public static function schema(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Pengguna')->schema([
                TextInput::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                Select::make('role')
                    ->label('Peran')
                    ->required()
                    ->options([
                        'admin'  => 'Admin',
                        'editor' => 'Editor',
                        'viewer' => 'Viewer',
                    ])
                    ->default('editor')
                    ->helperText('Admin & Editor dapat mengakses panel admin'),

                TextInput::make('nomor_hp')
                    ->label('Nomor HP')
                    ->tel()
                    ->nullable()
                    ->maxLength(20),
            ])->columns(2),

            Section::make('Keamanan')->schema([
                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->dehydrateStateUsing(fn($state) => filled($state) ? Hash::make($state) : null)
                    ->dehydrated(fn($state) => filled($state))
                    ->required(fn(string $operation): bool => $operation === 'create')
                    ->minLength(8)
                    ->helperText('Kosongkan jika tidak ingin mengubah password'),
            ]),

            Section::make('Foto Profil')->schema([
                FileUpload::make('foto')
                    ->label('Foto')
                    ->image()
                    ->imageEditor()
                    ->directory('avatars')
                    ->disk('public')
                    ->nullable()
                    ->avatar()
                    ->helperText('Format: JPG, PNG, WebP · Rasio 1:1 (persegi) disarankan'),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('public')
                    ->circular()
                    ->size(40)
                    ->defaultImageUrl(fn($record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->nama_lengkap) . '&background=14532d&color=fff'),
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable(),
                Tables\Columns\BadgeColumn::make('role')
                    ->label('Peran')
                    ->colors([
                        'danger'  => 'viewer',
                        'warning' => 'editor',
                        'success' => 'admin',
                    ])
                    ->formatStateUsing(fn($state) => match($state) {
                        'admin'  => 'Admin',
                        'editor' => 'Editor',
                        'viewer' => 'Viewer',
                        default  => ucfirst($state),
                    }),
                Tables\Columns\TextColumn::make('nomor_hp')
                    ->label('No. HP')
                    ->placeholder('—'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Bergabung')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->label('Peran')
                    ->options([
                        'admin'  => 'Admin',
                        'editor' => 'Editor',
                        'viewer' => 'Viewer',
                    ]),
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make()
                    ->requiresConfirmation()
                    ->before(function (User $record) {
                        // Prevent deleting the currently logged-in user
                        if ($record->id === auth()->id()) {
                            \Filament\Notifications\Notification::make()
                                ->danger()
                                ->title('Tidak bisa menghapus akun sendiri')
                                ->send();
                            $this->halt();
                        }
                    }),
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
            'index'  => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit'   => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
