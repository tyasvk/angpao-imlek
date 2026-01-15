<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AngpaoPoolResource\Pages;
use App\Filament\Resources\AngpaoPoolResource\RelationManagers;
use App\Models\AngpaoPool;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AngpaoPoolResource extends Resource
{
    protected static ?string $model = AngpaoPool::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Card::make()->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->placeholder('Contoh: Angpao Imlek Keluarga'),
                Forms\Components\TextInput::make('total_amount')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),
                Forms\Components\TextInput::make('total_slots')
                    ->numeric()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('remaining_slots', $state)),
                Forms\Components\Hidden::make('remaining_slots'),
                Forms\Components\Select::make('status')
                    ->options([
                        'active' => 'Aktif',
                        'closed' => 'Ditutup',
                    ])->default('active'),
            ])
        ]);
}

public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')->searchable(),
            Tables\Columns\TextColumn::make('total_amount')->money('IDR'),
            Tables\Columns\TextColumn::make('total_slots')->label('Total Kuota'),
            Tables\Columns\TextColumn::make('remaining_slots')->label('Sisa Kuota')
                ->badge()
                ->color(fn ($state) => $state > 0 ? 'success' : 'danger'),
            Tables\Columns\TextColumn::make('status')->badge(),
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
            'index' => Pages\ListAngpaoPools::route('/'),
            'create' => Pages\CreateAngpaoPool::route('/create'),
            'edit' => Pages\EditAngpaoPool::route('/{record}/edit'),
        ];
    }
}
