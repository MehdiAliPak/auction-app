<?php

namespace App\Filament\Resources\AuctionResource\Pages;

use App\Filament\Resources\AuctionResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListAuctions extends ListRecords
{
    protected static string $resource = AuctionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('All'),
            'pending' => Tab::make('Pending')->query(fn ($query) => $query->where('status', 'pending')),
            'accepted' => Tab::make('Accepted')->query(fn ($query) => $query->where('status', 'accepted')),
            'rejected' => Tab::make('Rejected')->query(fn ($query) => $query->where('status', 'rejected')),
            'ongoing' => Tab::make('Ongoing')->query(fn ($query) => $query->where('status', 'ongoing')),
            'finished' => Tab::make('Finished')->query(fn ($query) => $query->where('status', 'finished')),
            'cancelled' => Tab::make('Cancelled')->query(fn ($query) => $query->where('status', 'cancelled')),
        ];
    }
}