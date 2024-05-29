<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PfmoSuppliesResource\Pages;
use App\Filament\Resources\PfmoSuppliesResource\RelationManagers;
use App\Models\PfmoSupplies;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\PFMO_Supplies;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

use function PHPSTORM_META\type;

class PfmoSuppliesResource extends Resource
{

    protected static ?string $model = PFMO_Supplies::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    protected static ?string $navigationGroup = 'SUPPLY INVENTORY';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('stock_no')
                        ->label('Stock No.')
                        ->required()
                        ->rules(['gt:0'])
                        ->columnSpan(1)
                        ->type('number')
                        ->placeholder('Enter Stock No.'),
                    Select::make('unit')
                        ->label('Unit')
                        ->columnspan(1)
                        ->required()
                        ->placeholder('Select Unit')
                        ->options([
                            'box' => 'box',
                            'length' => 'length',
                            'lot' => 'lot',
                            'pack' => 'pack',
                            'pc.' => 'pc.',
                            'ream' => 'ream',
                            'roll' => 'roll',
                            'set' => 'set',
                            'unit' => 'unit',
                        ]),
                    TextInput::make('description')
                        ->label('Description')
                        ->columnspan(3)
                        ->required()
                        ->rules(['string', 'max:150'])
                        ->placeholder('Enter Description'),
                    TextInput::make('quantity')
                        ->label('Quantity')
                        ->columnspan(1)
                        ->required()
                        ->placeholder('Enter Quantity')
                        ->type('number')
                        ->rules(['gt:0']),

                ])
                
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
                //
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
            'index' => Pages\ListPfmoSupplies::route('/'),
            'create' => Pages\CreatePfmoSupplies::route('/create'),
            'edit' => Pages\EditPfmoSupplies::route('/{record}/edit'),
        ];
    }
}
