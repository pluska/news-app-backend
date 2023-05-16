<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreferencesController extends Controller
{
    /**
     * Update the user's preferences.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'preferredSources' => 'nullable|array',
            'preferredAuthors' => 'nullable|array',
            'preferredCategories' => 'nullable|array',
        ]);

        $preferences = [
            'preferredSources' => $request->input('preferredSources', []),
            'preferredAuthors' => $request->input('preferredAuthors', []),
            'preferredCategories' => $request->input('preferredCategories', []),
        ];

        $user->preferences = $preferences;
        $user->save();

        return response()->json(['message' => 'Preferences updated', 'user' => $user]);
    }
}
