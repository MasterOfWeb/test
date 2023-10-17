<?php

namespace App\Livewire;

use App\Models\Job;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CreatePost extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    protected $rules = [
        'title' => 'required',
        'price' => 'required',
        'description' => 'required|min:5',

    ];

    public function mount()
    {
//        $this->form->fill();

        $this->sent = false;
//        $this->email = NULL;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Titel')
                    ->required(),
                RichEditor::make('description')
                    ->label('Job Beschreibung')
                    ->toolbarButtons([
                        'bold',
                        'bulletList',
                        'h2',
                        'h3',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'undo',
                    ])
                    ->required(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->step(1),
            ])
            ->statePath('data');
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
