<?php

namespace App\Http\Livewire\Home;

use App\Models\Actress;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

use function PHPUnit\Framework\isEmpty;

class Actresses extends Component
{
    use WithPagination;
    public
        $isLoading = false,
        $search = '',
        $ageRanges,
        $debutRanges,
        $cupRanges,
        $heightRanges,
        $selectedAgeRange,
        $selectedDebutRange,
        $selectedCupRange,
        $selectedHeightRange;

    public function mount()
    {
        $this->ageRanges = $this->generateRanges('age');
        $this->debutRanges = $this->generateRanges('debut');
        $this->cupRanges = DB::table('actresses')->select('cup_size')->orderBy('cup_size', 'asc')->get();
        $this->heightRanges = $this->generateRanges('height');
    }

    public function render()
    {
        $actresses = $this->getActresses();
        return view('livewire.home.actresses', [
            'actresses' => $actresses
        ]);
    }

    public function updated($propertyName)
    {
        $this->getActresses();
    }

    public function getActresses()
    {
        $query = Actress::search(['name'], $this->search)
            ->with('posts')
            ->latest('id');

        if ($this->selectedAgeRange) {
            $ageRangeParts = explode('-', $this->selectedAgeRange);
            if (count($ageRangeParts) === 2) {
                $minAge = intval($ageRangeParts[0]);
                $maxAge = intval($ageRangeParts[1]);
                $query->where('age', '>=', $minAge)
                    ->where('age', '<=', $maxAge);
            }
        }

        if ($this->selectedDebutRange) {
            $debutRangeParts = explode('-', $this->selectedDebutRange);
            if (count($debutRangeParts) === 2) {
                $min = intval($debutRangeParts[0]);
                $max = intval($debutRangeParts[1]);
                $query->where('debut', '>=', $min)
                    ->where('debut', '<=', $max);
            }
        }

        if ($this->selectedCupRange) {
            $rangeParts = $this->selectedCupRange;
            $query->where('cup_size', $rangeParts);
        }

        if ($this->selectedHeightRange) {
            $rangeParts = explode('-', $this->selectedHeightRange);
            if (count($rangeParts) === 2) {
                $min = intval($rangeParts[0]);
                $max = intval($rangeParts[1]);
                $query->where('height', '>=', $min)
                    ->where('height', '<=', $max);
            }
        }

        return $query->paginate(18);
        $this->isLoading = false;
    }

    private function generateRanges($prop)
    {
        $minAge = DB::table('actresses')->min($prop);
        $maxAge = DB::table('actresses')->max($prop);
        $ageRanges = [];

        for ($age = $minAge; $age <= $maxAge; $age += 2) {
            $rangeStart = $age;
            $rangeEnd = $age + 2;
            $ageRanges[] = "$rangeStart-$rangeEnd";
        }

        return $ageRanges;
    }

    // private function generateCup
}
