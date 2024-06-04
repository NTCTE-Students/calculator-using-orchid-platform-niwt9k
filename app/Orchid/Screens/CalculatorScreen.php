<?php

namespace App\Orchid\Screens;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\TD;
class CalculatorScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public $numberOne;
    public $numberTwo;
    public $result;
    public function set_operation()
    {
        $result = null;
        switch (request() -> input('operation')) {
            case '*':
                $result = request() -> input('subjectN1') * request() -> input('subjectN2');
            break;
            case '+':
                $result = request() -> input('subjectN1') + request() -> input('subjectN2');
            break;
            case '-':
                $result = request() -> input('subjectN1') - request() -> input('subjectN2');
            break;
            case '/':
                $result = request() -> input('subjectN1') / request() -> input('subjectN2');
            break;
            case '%':
                $result = request() -> input('subjectN1') % request() -> input('subjectN2');
            break;
            case '**':
                $result = request() -> input('subjectN1') ** request() -> input('subjectN2');
            break;
            case 'log':
                $result = log(request() -> input('subjectN1'));
            break;
        }

        Toast::warning($result)
            ->autoHide(false);
    }
    public function query(): array
    {
        return [

        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'CalculatorScreen';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Save')
                ->method('')

        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                $numberOne = Input::make('subjectN1')->type('number')
                    ->title('N1')
                    ->required()
                    ->placeholder('Первое число'),
                $numberTwo = Input::make('subjectN2')->type('number')
                    ->title('N2')
                    ->placeholder('Второе число'),
            Button::make('Multiply')
                ->method('set_operation', [
                    'operation' => '*',
                ]),
            Button::make('Summary')
                ->method('set_operation', [
                    'operation' => '+',
                ]),
            Button::make('Subtraction')
                ->method('set_operation', [
                    'operation' => '-',
                ]),
            Button::make('Fission')
                ->method('set_operation', [
                    'operation' => '/',
                ]),
            Button::make('Remainder of division')
                ->method('set_operation', [
                    'operation' => '%',
                ]),
            Button::make('Degree')
                ->method('set_operation', [
                'operation' => '**',
                ]),
            Button::make('Log')
                ->method('set_operation', [
                'operation' => 'log',
                ]),
            Button::make('Trigonometric functions')
                ->method(''),

                ]),];
    }
}
