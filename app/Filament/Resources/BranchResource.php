<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BranchResource\Pages;
use App\Filament\Resources\BranchResource\RelationManagers;
use App\Models\Branch;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BranchResource extends Resource
{
    protected static ?string $model = Branch::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-trending-up';
    protected static ?string $navigationLabel = 'Ветки';
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $pluralModelLabel = 'Ветки';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Название')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->label('Описание')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('image_url')
                    ->image()
                    ->label('Изображение')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('priority_rank')
                    ->label('Позиция в профиле')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('requirement_role_id')
                    ->relationship(name: 'reqRole', titleAttribute: 'name')
                    ->label('Требуемая роль')
                    ->required(),
                Forms\Components\Select::make('requirement_rank_id')
                    ->relationship(name: 'reqRank', titleAttribute: 'name')
                    ->label('Требуемый ранг')
                    ->required(),
                Forms\Components\TextInput::make('requirement_experience')
                    ->label('Требуемый опыт')
                    ->required()
                    ->numeric(),
                Forms\Components\Toggle::make('is_visible')
                    ->label('Флаг отображения')
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->label('Флаг активности')
                    ->required(),
                Forms\Components\TextInput::make('reward_experience')
                    ->label('Опыт за выполнение')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('reward_gold')
                    ->label('Валюта за выполнение')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('missions')
                    ->relationship(name: 'missions', titleAttribute: 'name')
                    ->label('Миссии внутри ветки')
                    ->multiple(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->searchable(),
                Tables\Columns\TextColumn::make('priority_rank')
                    ->label('Позиция в профиле')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('reqRole.name')
                    ->label('Требуемая роль')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('reqRank.name')
                    ->label('Требуемый ранг')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('requirement_experience')
                    ->label('Требуемый опыт')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_visible')
                    ->label('Флаг отображения')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Флаг активности')
                    ->boolean(),
                Tables\Columns\TextColumn::make('reward_experience')
                    ->label('Опыт за выполнение')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('reward_gold')
                    ->label('Валюта за выполнение')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListBranches::route('/'),
            'create' => Pages\CreateBranch::route('/create'),
            'edit' => Pages\EditBranch::route('/{record}/edit'),
        ];
    }
}
