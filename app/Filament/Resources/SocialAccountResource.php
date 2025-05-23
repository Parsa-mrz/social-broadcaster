<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocialAccountResource\Pages;
use App\Filament\Resources\SocialAccountResource\RelationManagers;
use App\Models\SocialAccount;
use App\Policies\SocialAccountPolicy;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SocialAccountResource extends Resource
{
    protected static ?string $model = SocialAccount::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function shouldRegisterNavigation(): bool
    {
        if(Auth::check () && Auth::user ()->isAdmin()){
            return true;
        }
        return Auth::check () && Auth::user()->hasActiveSubscription();
    }

    public static function getNavigationBadge(): ?string
    {
        return Auth::user()->socialAccounts()->count();
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('platform')
                    ->options([
                        'instagram' => 'Instagram',
                        'telegram' => 'Telegram',
                        'wordpress' => 'WordPress',
                    ])
                    ->disabled ()
                    ->dehydrated (true)
                    ->required()
                    ->columnSpanFull (),
                Forms\Components\Repeater::make('settings')
                    ->schema([
                        Forms\Components\TextInput::make('key')
                        ->label('Key')
                        ->disabled ()
                        ->dehydrated(true)
                        ->required(),
                        Forms\Components\TextInput::make('value')
                        ->label('Value')
                        ->dehydrated(true)
                        ->required()
                            ->afterStateHydrated(function ($component, $state) {
                                $record = $component->getContainer()->getParentComponent()->getRecord();

                                if ($record && Gate::denies('decrypt', $record)) {
                                    $component->state('********');
                                }
                            }),
                    ])->columns (2)
                    ->required()
                    ->columnSpanFull ()
                ->addable (false)
                ->deletable (false)
                ->reorderable (false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('platform')
                    ->formatStateUsing(fn(string $state) => ucfirst($state)),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([

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
            'index' => Pages\ListSocialAccounts::route('/'),
            'create' => Pages\CreateSocialAccount::route('/create'),
            'edit' => Pages\EditSocialAccount::route('/{record}/edit'),
        ];
    }
}
