<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AuctionResource\Pages;
use App\Filament\Resources\AuctionResource\RelationManagers;
use App\Models\Auction;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AuctionResource extends Resource
{
    protected static ?string $model = Auction::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Auction Information')
                        ->schema([
                            TextInput::make('name')->required(),
                            MarkdownEditor::make('description')->columnSpanFull()->fileAttachmentsDirectory('auctions'),
                            DateTimePicker::make('start_date')->required()->minDate(now()),
                            DateTimePicker::make('end_date')->required(),
                            DatePicker::make('register_start_date')->required(),
                            DatePicker::make('register_end_date')->required(),
                        ])->columns(2),
                    Section::make('Images and Files')
                        ->schema([
                            Group::make()->schema([
                                FileUpload::make('file')->directory('auctions')->acceptedFileTypes(['application/pdf']),
                                FileUpload::make('images')->image()->multiple()->maxFiles(5)->reorderable()->directory('auctions'),
                            ]),
                        ])
                ])->columnSpan(2),
                Group::make()->schema([
                    Section::make('Belongs to')
                        ->schema([
                            Select::make('user_id')
                                ->required()->searchable()->preload()->relationship('auctionOwner', 'name')
                        ]),
                    Section::make('Base Price')
                        ->schema([
                            TextInput::make('base_price')->required()->numeric()->prefix('IRR'),
                        ]),
                    Section::make('Status')
                        ->schema([
                            ToggleButtons::make('status')
                                ->inline()
                                ->options(Auction::getStatusOptions())
                                ->colors(Auction::getStatusOptionsColor())
                                ->icons(Auction::getStatusOptionsIcon())
                                ->default('pending')
                                ->required(),
                        ])
                ])->columnSpan(1),
            ])->columns(3);
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
            'index' => Pages\ListAuctions::route('/'),
            'create' => Pages\CreateAuction::route('/create'),
            'edit' => Pages\EditAuction::route('/{record}/edit'),
        ];
    }
}