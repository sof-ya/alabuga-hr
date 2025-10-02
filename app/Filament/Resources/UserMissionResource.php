<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserMissionResource\Pages;
use App\Filament\Resources\UserMissionResource\RelationManagers;
use App\Models\UserMission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserMissionResource extends Resource
{
    protected static ?string $model = UserMission::class;

    protected static ?string $navigationIcon = 'heroicon-o-check';
    protected static ?string $navigationLabel = 'Результаты миссий';
    protected static ?string $modelLabel = 'Результат выполнения миссии';
    protected static ?string $pluralModelLabel = 'Результаты миссий';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->disabled()
                    ->required()
                    ->label('Имя пользователя'),
                Forms\Components\Select::make('mission_id')
                    ->relationship('mission', 'name')
                    ->disabled()
                    ->required()
                    ->label('Название миссии'),
                Forms\Components\Select::make('status_mission')
                    ->required()->options([
                        'Проверено' => 'Проверено',
                        'Ожидает проверку' => 'Ожидает проверку',
                        'Завершено' => 'Завершено',
                    ])
                    ->label('Статус миссии'),
                Forms\Components\Textarea::make('result')
                    ->label('Текст')
                    ->rows(4)
                    ->columnSpanFull()
                    ->label('Результат пользователя'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable()
                    ->label('Имя пользователя'),
                Tables\Columns\TextColumn::make('mission.name')
                    ->numeric()
                    ->sortable()
                    ->label('Название миссии'),
                Tables\Columns\TextColumn::make('status_mission')
                    ->searchable()
                    ->label('Статус миссии'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Дата создания'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Дата редактирования'),
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
            'index' => Pages\ListUserMissions::route('/'),
            'create' => Pages\CreateUserMission::route('/create'),
            'edit' => Pages\EditUserMission::route('/{record}/edit'),
        ];
    }
}
