<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use App\Models\CustomerModel;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
    protected static ?string $model = CustomerModel::class;

    // custom icon navigasi
    protected static ?string $navigationIcon = 'heroicon-o-user';

    // custom nama navigasi
    protected static ?string $navigationLabel = 'Kelola Customer';

    // custom slug
    protected static ?string $slug = 'kelola-customer';

    // custom group
    protected static ?string $navigationGroup = 'Kelola';

    // custom label
    public static ?string $label = 'Kelola Customer';
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_customer')
                    ->required()
                    ->label('Nama')
                    ->placeholder('masukkan nama customer'),
                TextInput::make('kode_customer')
                    ->required()
                    ->placeholder('masukkan kode customer')
                    ->numeric()
                    ->label('Kode'),
                TextInput::make('alamat_customer')
                    ->required()
                    ->placeholder('masukkan alamat customer')
                    ->label('Alamat'),
                TextInput::make('telepon_customer')
                    ->required()
                    ->placeholder('masukkan telepon customer')
                    ->label('Telepon'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_customer')
                    ->copyable()
                    ->label('Kode'),
                TextColumn::make('nama_customer')
                    ->sortable()
                    // copyable tidak bekerja
                    ->copyable()
                    ->copyMessage('Nama Customer disalin')
                    ->copyMessageDuration(1500)
                    ->label('Nama'),
                TextColumn::make('alamat_customer')
                    ->label('Alamat'),
                TextColumn::make('telepon_customer')
                    ->label('Telepon'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}