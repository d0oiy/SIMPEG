<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Spatie\Permission\Models\Role;
use Filament\Tables\Columns\TextColumn;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->required(),

            TextInput::make('email')
                ->email()
                ->required(),

            TextInput::make('password')
                ->label('Password')
                ->password()
                ->required(fn (string $context) => $context === 'create') // Wajib di create, opsional saat edit
                ->dehydrated(fn ($state) => filled($state)) // hanya kirim kalau tidak kosong
                ->dehydrateStateUsing(fn ($state) => bcrypt($state)),

            Select::make('role')
                ->label('Role')
                ->options(Role::pluck('name', 'name')->toArray())
                ->required()
                ->searchable(),

            TextInput::make('jabatan')
                ->label('Jabatan')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 TextColumn::make('name')->searchable(),
            TextColumn::make('email'),
            TextColumn::make('roles.name')->label('Role'),
            TextColumn::make('jabatan')->label('Jabatan'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
