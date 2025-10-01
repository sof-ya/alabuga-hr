<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MissionResource\Pages;
use App\Filament\Resources\MissionResource\RelationManagers;
use App\Models\Mission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MissionResource extends Resource
{
    protected static ?string $model = Mission::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationLabel = 'Миссии';
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $pluralModelLabel = 'Миссии';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Название'),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull()
                    ->label('Описание'),
                Forms\Components\FileUpload::make('image_url')
                    ->image()
                    ->columnSpanFull()
                    ->label('Изображение'),
                Forms\Components\Select::make('mission_category_id')
                    ->relationship('missionCategory', 'name')
                    ->required()
                    ->label('Категория миссиии'),
                Forms\Components\Select::make('requirement_role_id')
                    ->relationship('role', 'name')
                    ->required()
                    ->label('Требуемая роль'),
                Forms\Components\Select::make('requirement_rank_id')
                    ->relationship('requirementRank', 'name')
                    ->required()
                    ->label('Требуемый ранг'),
                Forms\Components\TextInput::make('requirement_experience')
                    ->required()
                    ->numeric()
                    ->label('Требуемый опыт'),
                Forms\Components\Toggle::make('is_visible')
                    ->required()
                    ->label('Флаг видимости'),
                Forms\Components\Toggle::make('is_active')
                    ->required()
                    ->label('Флаг активности'),
                Forms\Components\Toggle::make('is_requirement_text')
                    ->required()
                    ->label('Флаг обязательного добавления текста в результат'),
                Forms\Components\Toggle::make('is_requirement_file')
                    ->required()
                    ->label('Флаг обязательного добавления файла в результат'),
                Forms\Components\TextInput::make('reward_experience')
                    ->required()
                    ->numeric()
                    ->label('Опыт за выполнение'),
                Forms\Components\TextInput::make('reward_gold')
                    ->required()
                    ->numeric()
                    ->label('Валюта за выполнение'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Название'),
                Tables\Columns\TextColumn::make('missionCategory.name')
                    ->numeric()
                    ->sortable()
                    ->label('Категория миссиии'),
                Tables\Columns\TextColumn::make('role.name')
                    ->numeric()
                    ->sortable()
                    ->label('Требуемая роль'),
                Tables\Columns\TextColumn::make('requirementRank.name')
                    ->numeric()
                    ->sortable()
                    ->label('Требуемый ранг'),
                Tables\Columns\TextColumn::make('requirement_experience')
                    ->numeric()
                    ->sortable()
                    ->label('Требуемый опыт'),
                Tables\Columns\IconColumn::make('is_visible')
                    ->boolean()
                    ->label('Флаг видимости'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Флаг активности'),
                Tables\Columns\TextColumn::make('reward_experience')
                    ->numeric()
                    ->sortable()
                    ->label('Опыт за выполнение'),
                Tables\Columns\TextColumn::make('reward_gold')
                    ->numeric()
                    ->sortable()
                    ->label('Валюта за выполнение'),
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
            'index' => Pages\ListMissions::route('/'),
            'create' => Pages\CreateMission::route('/create'),
            'edit' => Pages\EditMission::route('/{record}/edit'),
        ];
    }
}
