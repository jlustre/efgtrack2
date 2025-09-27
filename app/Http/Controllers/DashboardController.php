<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        $user = $request->user();
        
        // Double-check authentication
        if (!$user) {
            return redirect()->route('login');
        }
        
        // Redirect to role-specific dashboard
        if ($user->hasRole('admin')) {
            return $this->adminDashboard($user);
        } elseif ($user->hasRole('manager')) {
            return $this->managerDashboard($user);
        } elseif ($user->hasRole('mentor')) {
            return $this->mentorDashboard($user);
        } elseif ($user->hasRole('member')) {
            return $this->memberDashboard($user);
        }
        
        // Default dashboard for users without roles
        return view('dashboards.default', compact('user'));
    }
    
    private function adminDashboard($user): View
    {
        // Admin can see everything - system-wide analytics
        $stats = [
            'total_users' => \App\Models\User::count(),
            'total_admins' => \App\Models\User::role('admin')->count(),
            'total_managers' => \App\Models\User::role('manager')->count(),
            'total_mentors' => \App\Models\User::role('mentor')->count(),
            'total_members' => \App\Models\User::role('member')->count(),
        ];
        
        return view('dashboards.admin', compact('user', 'stats'));
    }
    
    private function managerDashboard($user): View
    {
        // Manager dashboard - can see their team hierarchy
        $stats = [
            'team_members' => 0, // TODO: Implement team hierarchy
            'active_mentors' => \App\Models\User::role('mentor')->count(),
            'total_leads' => 0, // TODO: Implement leads
        ];
        
        return view('dashboards.manager', compact('user', 'stats'));
    }
    
    private function mentorDashboard($user): View
    {
        // Mentor dashboard - can see their assigned members
        $stats = [
            'assigned_members' => 0, // TODO: Implement mentoring assignments
            'completed_sessions' => 0, // TODO: Implement session tracking
            'pending_tasks' => 0, // TODO: Implement task system
        ];
        
        return view('dashboards.mentor', compact('user', 'stats'));
    }
    
    private function memberDashboard($user): View
    {
        // Member dashboard - personal progress and training
        $stats = [
            'completed_modules' => 0, // TODO: Implement training modules
            'pending_tasks' => 0, // TODO: Implement task system
            'next_session' => null, // TODO: Implement session scheduling
        ];
        
        return view('dashboards.member', compact('user', 'stats'));
    }
    
    /**
     * Allow mentors to view member dashboards they mentor
     * Allow managers to view dashboards of their hierarchy
     * Allow admins to view any dashboard
     */
    public function viewUserDashboard(Request $request, $userId): View|RedirectResponse
    {
        $viewer = $request->user();
        
        // Double-check authentication
        if (!$viewer) {
            return redirect()->route('login');
        }
        
        $targetUser = \App\Models\User::findOrFail($userId);
        
        // Admin can view any dashboard
        if ($viewer->hasRole('admin')) {
            return $this->getDashboardForUser($targetUser, $viewer, 'admin_viewing');
        }
        
        // Manager can view dashboards in their hierarchy
        if ($viewer->hasRole('manager')) {
            // TODO: Implement hierarchy checking
            // For now, managers can view mentor and member dashboards
            if ($targetUser->hasRole(['mentor', 'member'])) {
                return $this->getDashboardForUser($targetUser, $viewer, 'manager_viewing');
            }
        }
        
        // Mentor can view dashboards of members they mentor
        if ($viewer->hasRole('mentor')) {
            // TODO: Implement mentoring relationship checking
            // For now, mentors can view member dashboards
            if ($targetUser->hasRole('member')) {
                return $this->getDashboardForUser($targetUser, $viewer, 'mentor_viewing');
            }
        }
        
        abort(403, 'Unauthorized to view this dashboard');
    }
    
    private function getDashboardForUser($user, $viewer, $context): View
    {
        $viewingContext = [
            'viewer' => $viewer,
            'context' => $context,
            'viewing_as' => $user->name
        ];
        
        if ($user->hasRole('admin')) {
            return $this->adminDashboard($user)->with('viewingContext', $viewingContext);
        } elseif ($user->hasRole('manager')) {
            return $this->managerDashboard($user)->with('viewingContext', $viewingContext);
        } elseif ($user->hasRole('mentor')) {
            return $this->mentorDashboard($user)->with('viewingContext', $viewingContext);
        } elseif ($user->hasRole('member')) {
            return $this->memberDashboard($user)->with('viewingContext', $viewingContext);
        }
        
        return view('dashboards.default', compact('user'))->with('viewingContext', $viewingContext);
    }
}
