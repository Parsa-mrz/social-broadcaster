<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubscriptionPlanResource\Pages;
use App\Filament\Resources\SubscriptionPlanResource\RelationManagers;
use App\Models\SubscriptionPlan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubscriptionPlanResource extends Resource
{
    protected static ?string $model = SubscriptionPlan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Forms\Components\TextInput::make('discount')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('currency_id')
                    ->relationship('currency', 'name')
                    ->required(),
                Forms\Components\TextInput::make('interval')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('features')
                    ->required(),
                Forms\Components\Select::make('is_active')
                    ->options ([
                        '1' => 'Active',
                        '0' => 'Inactive',
                    ])
                    ->native (false)
                    ->required(),
                Forms\Components\Repeater::make('limits')
                    ->schema ([
                        Forms\Components\Select::make('social')
                                               ->label ('Social Network')
                                                ->options(function (callable $get, $component) {
                                                    $allItems = $get('../../limits') ?? [];
                                                    $currentItemIndex = $component->getContainer()->getParentComponent()->getKey();

                                                    $selectedSocials = collect($allItems)
                                                        ->filter(function ($item, $index) use ($currentItemIndex) {
                                                            return $index !== $currentItemIndex;
                                                        })
                                                        ->pluck('social')
                                                        ->filter()
                                                        ->toArray();

                                                    $allOptions = [
                                                        'instagram' => 'Instagram',
                                                        'telegram' => 'Telegram',
                                                        'wordpress' => 'WordPress',
                                                    ];

                                                    return array_diff_key($allOptions, array_flip($selectedSocials));
                                                })
                                               ->native (false)
                                               ->searchable ()
                                               ->reactive()
                                               ->required(),
                        Forms\Components\TextInput::make('limit_per_post')
                                                  ->numeric()

                    ])
                    ->columns (2)
                ->columnSpanFull ()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('discount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('currency.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('interval')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListSubscriptionPlans::route('/'),
            'create' => Pages\CreateSubscriptionPlan::route('/create'),
            'edit' => Pages\EditSubscriptionPlan::route('/{record}/edit'),
        ];
    }
}
