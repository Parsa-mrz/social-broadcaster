<?php

namespace App\Filament\Resources;

use App\Enums\PostPlatformStatusEnum;
use App\Filament\Resources\PostPlatformResource\Pages;
use App\Filament\Resources\PostPlatformResource\RelationManagers;
use App\Models\PostPlatform;
use App\Policies\PostPlatformPolicy;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use function app;
use function auth;

class PostPlatformResource extends Resource
{
    protected static ?string $model = PostPlatform::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationBadge(): ?string
    {
        $user = Auth::user();

        if ($user->isCustomer()) {
            $posts = $user->posts()->with('postPlatforms')->get();

            $count = $posts->sum(function ($post) {
                return $post->postPlatforms->count();
            });

            return $count;
        }

        return static::getModel()::count();
    }

    public static function getEloquentQuery(): Builder
    {
        return app(PostPlatformPolicy::class)
            ->scopeVisible(parent::getEloquentQuery(), auth()->user());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('post_id')
                                       ->label('Post')
                                        ->relationship(
                                            name: 'post',
                                            titleAttribute: 'title',
                                            modifyQueryUsing: fn ($query) => $query->where('user_id', Auth::id())
                                        )
                                       ->searchable()
                                       ->preload ()
                                       ->required(),
                Forms\Components\Select::make('social_account_id')
                                       ->label('Social Account')
                                        ->relationship(
                                            name: 'socialAccount',
                                            titleAttribute: 'platform',
                                            modifyQueryUsing: fn ($query) => $query->where('user_id', Auth::id())
                                        )
                                       ->searchable()
                                       ->preload ()
                                       ->required(),
                Forms\Components\DateTimePicker::make('scheduled_at') -> columnSpanFull (),
                Forms\Components\DateTimePicker::make('published_at')
                ->disabled (),
                Forms\Components\Select::make('status')
                ->label('Status')
                ->default (PostPlatformStatusEnum::SCHEDULED->value)
                ->options([
                    PostPlatformStatusEnum::PUBLISHED->value => __('Published'),
                    PostPlatformStatusEnum::SCHEDULED->value => __('Scheduled'),
                    PostPlatformStatusEnum::FAILED->value => __('Failed'),
                ])
                ->native (false),
                Forms\Components\Textarea::make('responses')
                ->disabled ()
                ->columnSpanFull ()
                ->rows (6),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('post.title')
                                         ->label('Post'),
                Tables\Columns\TextColumn::make('socialAccount.platform')
                    ->label('Platform')
                    ->sortable(),
                Tables\Columns\TextColumn::make('scheduled_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                                         ->searchable()
                                         ->badge()
                                         ->formatStateUsing(fn (string $state): string => ucfirst($state))
                                         ->color(fn (string $state): string => match ($state) {
                                             PostPlatformStatusEnum::SCHEDULED->value => 'warning',
                                             PostPlatformStatusEnum::PUBLISHED->value => 'success',
                                             PostPlatformStatusEnum::FAILED->value => 'danger',
                                             default => 'gray',
                                         }),
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
            'index' => Pages\ListPostPlatforms::route('/'),
            'create' => Pages\CreatePostPlatform::route('/create'),
            'edit' => Pages\EditPostPlatform::route('/{record}/edit'),
        ];
    }
}
