<?php

namespace App\Livewire;

use App\Models\Link;
use Livewire\Component;

class AdminDashboard extends Component
{
    public function deleteLink($id)
    {
        $link = Link::where('user_id', auth()->id())->findOrFail($id);
        $link->delete();
        session()->flash('message', 'Link excluído com sucesso.');
    }

    public function render()
    {
        $links = Link::where('user_id', auth()->id())->latest()->get();
        $totalLinks = $links->count();
        $totalClicks = $links->sum('clicks');
        $topLink = $links->sortByDesc('clicks')->first();

        return view('livewire.admin-dashboard', [
            'links' => $links,
            'totalLinks' => $totalLinks,
            'totalClicks' => $totalClicks,
            'topLink' => $topLink,
        ]);
    }
}
