<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

/**
 * UserResource - Filament Admin Interface for User Management
 * 
 * This resource provides a complete CRUD interface for managing users
 * in the Filament admin panel. It includes forms for creating/editing
 * users and tables for listing and managing user data.
 */
class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    /**
     * Define the form schema for creating and editing users
     * 
     * This form includes all the fields needed for user management,
     * including profile information and social links.
     */
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            // Basic user information
            Forms\Components\TextInput::make('name')
                ->required()
                ->label('Full Name')
                ->placeholder('Enter user\'s full name'),

            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->label('Email Address')
                ->placeholder('user@example.com'),

            // Profile photo upload with image editing capabilities
            Forms\Components\FileUpload::make('profile_photo_path') 
                ->disk('public')           // Store in public disk
                ->directory('avatars')     // Store in avatars subdirectory
                ->image()                  // Only allow image files
                ->imageEditor()            // Enable image editing tools
                ->label('Profile Picture')
                ->helperText('Upload a profile picture (optional)'),

            // Password field with conditional requirements
            Forms\Components\TextInput::make('password')
                ->password()
                ->dehydrateStateUsing(fn ($state) => !empty($state) ? bcrypt($state) : null)
                ->required(fn ($context) => $context === 'create') // Required only when creating
                ->dehydrated(fn ($state) => filled($state))        // Only save if filled
                ->label('Password')
                ->helperText('Leave empty to keep current password (when editing)'),
            
            // Extended profile information
            Forms\Components\Textarea::make('description')
                ->label('Bio/Description')
                ->rows(3)
                ->maxLength(5000)
                ->helperText('Brief description about the user (for author bio)')
                ->placeholder('Tell us about yourself...'),
            
            // Social media integration
            Forms\Components\TextInput::make('url_link')
                ->label('LinkedIn URL')
                ->placeholder('https://www.linkedin.com/in/username')
                ->url()                    // Validates URL format
                ->maxLength(255)
                ->helperText('Professional profile or website URL'),

        ]);
    }

    /**
     * Define the table schema for listing users
     * 
     * This table shows user information in a searchable, sortable format
     * with actions for editing and managing users.
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Profile photo column with square aspect ratio
                Tables\Columns\ImageColumn::make('profile_photo_path')
                    ->label('Profile')
                    ->square()
                    ->defaultImageUrl(fn ($record) => 
                        'https://ui-avatars.com/api/?name=' . urlencode($record->name)
                    ),

                // User's name with search capability
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Full Name'),

                // Email with search capability
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->label('Email Address'),

                // Description with character limit for table display
                Tables\Columns\TextColumn::make('description')
                    ->limit(30)
                    ->label('Description')
                    ->tooltip(fn ($record) => $record->description), // Show full text on hover

                // Creation date for reference
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Joined')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Add filters here if needed
                // For example: filter by role, status, etc.
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    /**
     * Define relationship managers for this resource
     * 
     * This is where you would add relationship managers
     * for related data like posts, comments, etc.
     */
    public static function getRelations(): array
    {
        return [
            // Add relationship managers here
            // For example: PostsRelationManager::class,
        ];
    }

    /**
     * Define the pages available for this resource
     * 
     * Standard CRUD pages: list, create, edit
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
