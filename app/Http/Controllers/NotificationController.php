<?php

namespace App\Http\Controllers;

use App\Models\User;

class NotificationController extends Controller
{
    /**
     * Shows all the alert notifications.
     *
     * @return \Illuminate\Http\Response
     */
    public function alert()
    {
        $alerts = User::findOrFail(auth()->user()->id)
            ->notifications()
            ->where('type', 'App\Notifications\ItemDeleted')
            ->paginate(10);

        return view('admin.notifications.alerts', compact('alerts'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function clearALert()
    {
        try {
            User::findOrFail(auth()->user()->id)
                ->notifications()
                ->where('type', 'App\Notifications\ItemDeleted')
                ->delete();

            toast('Alerts removed successfully', 'success');

            return redirect()->back();
        }
        catch (\Exception$exception)
        {
            return redirect()->back()->withError(
                $exception->getMessage()
            );
        }
    }
}
