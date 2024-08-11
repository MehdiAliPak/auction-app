<?php

namespace App\Filament\Resources\AuctionResource\Pages;

use App\Filament\Resources\AuctionResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListAuctions extends ListRecords
{
    protected static string $resource = AuctionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        $query = parent::getTableQuery();

        if (auth()->user()->role === 'user') {
            return $query->where('user_id', auth()->id());
        }

        return $query;
    }


    public function getTabs(): array
    {
        $tabs = [
            null => Tab::make('All'),
            'pending' => Tab::make('Pending')->query(fn($query) => $query->where('status', 'pending')),
            'accepted' => Tab::make('Accepted')->query(fn($query) => $query->where('status', 'accepted')),
            'rejected' => Tab::make('Rejected')->query(fn($query) => $query->where('status', 'rejected')),
            'ongoing' => Tab::make('Ongoing')->query(fn($query) => $query->where('status', 'ongoing')),
            'finished' => Tab::make('Finished')->query(fn($query) => $query->where('status', 'finished')),
            'cancelled' => Tab::make('Cancelled')->query(fn($query) => $query->where('status', 'cancelled')),
        ];

        if (auth()->user()->role === 'user') {
            foreach ($tabs as $key => $tab) {
                $tabs[$key] = $tab->query(fn($query) => $query->where('user_id', auth()->id()));
            }
        }


        return $tabs;
    }
}