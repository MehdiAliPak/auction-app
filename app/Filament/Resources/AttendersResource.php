<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttendersResource\Pages;
use App\Filament\Resources\AttendersResource\RelationManagers;
use App\Models\Attenders;
use App\Models\Auction;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AttendersResource extends Resource
{
    protected static ?string $model = Attenders::class;

    protected static ?string $navigationIcon = 'heroicon-o-numbered-list';

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
                TextColumn::make('id')->searchable()->sortable(),
                TextColumn::make('user_name')
                    ->label('User Name')
                    ->sortable()
                    ->searchable()
                    ->getStateUsing(fn($record) => User::find($record->user_id)?->name ?? '-'),
                TextColumn::make('auction_name')
                    ->label('Auction Name')
                    ->sortable()
                    ->searchable()
                    ->getStateUsing(fn($record) => Auction::find($record->auction_id)?->name ?? '-'),
                TextColumn::make('auction_status')
                    ->label('Auction Status')
                    ->sortable()
                    ->searchable()
                    ->getStateUsing(fn($record) => Auction::find($record->auction_id)?->status ?? '-')
                    ->badge()->color(fn(string $state): string => match ($state) {
                        'pending' => 'primary',
                        'accepted' => 'info',
                        'rejected' => 'danger',
                        'ongoing' => 'success',
                        'finished' => 'success',
                    }),
                TextColumn::make('attender_register_date')
                    ->label('Registered At')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListAttenders::route('/'),
            // 'create' => Pages\CreateAttenders::route('/create'),
            // 'edit' => Pages\EditAttenders::route('/{record}/edit'),
        ];
    }
}