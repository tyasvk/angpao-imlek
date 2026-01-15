<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AngpaoClaimResource\Pages;
use App\Filament\Resources\AngpaoClaimResource\RelationManagers;
use App\Models\AngpaoClaim;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AngpaoClaimResource extends Resource
{
    protected static ?string $model = AngpaoClaim::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('pool.name')->label('Nama Event'),
            Tables\Columns\TextColumn::make('claimed_by')->label('Nama Pengambil')->searchable(),
            Tables\Columns\TextColumn::make('amount')->money('IDR')->sortable(),
            Tables\Columns\TextColumn::make('created_at')->label('Waktu Ambil')->dateTime(),
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
            'index' => Pages\ListAngpaoClaims::route('/'),
            'create' => Pages\CreateAngpaoClaim::route('/create'),
            'view' => Pages\ViewAngpaoClaim::route('/{record}'),
            'edit' => Pages\EditAngpaoClaim::route('/{record}/edit'),
        ];
    }
}
