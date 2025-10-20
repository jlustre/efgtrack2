<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        $user = $request->user();
        
        // Double-check authentication
        if (!$user) {
            return redirect()->route('login');
        }
        
        // Redirect to role-specific dashboard. Guard role checks in case
        // Spatie permission tables are not present (test environments may use
        // a minimal SQLite DB without those tables).
        $rolesAvailable = false;
        try {
            $rolesAvailable = Schema::hasTable('roles') && Schema::hasTable('model_has_roles');
        } catch (\Throwable $e) {
            $rolesAvailable = false;
        }

        if ($rolesAvailable) {
            try {
                if ($user->hasRole('admin')) {
                    return $this->adminDashboard($user);
                } elseif ($user->hasRole('manager')) {
                    return $this->managerDashboard($user);
                } elseif ($user->hasRole('mentor')) {
                    return $this->mentorDashboard($user);
                } elseif ($user->hasRole('member')) {
                    return $this->memberDashboard($user);
                }
            } catch (\Throwable $e) {
                // If role checking fails for any reason, fall through to default
            }
        }
        
        // Default dashboard for users without roles
        return view('dashboards.default', compact('user'));
    }
    
    private function adminDashboard($user): View
    {
        // Admin can see everything - system-wide analytics
        // Gather stats, but guard role-based counts if roles tables are absent.
        $stats = [
            'total_users' => User::count(),
            'total_admins' => 0,
            'total_managers' => 0,
            'total_mentors' => 0,
            'total_members' => 0,
        ];

        try {
            if (Schema::hasTable('roles') && Schema::hasTable('model_has_roles')) {
                $stats['total_admins'] = User::role('admin')->count();
                $stats['total_managers'] = User::role('manager')->count();
                $stats['total_mentors'] = User::role('mentor')->count();
                $stats['total_members'] = User::role('member')->count();
            }
        } catch (\Throwable $e) {
            // leave role counts as zero if role queries fail
        }
        
        return view('dashboards.admin', compact('user', 'stats'));
    }
    
    private function managerDashboard($user): View
    {
        // Manager dashboard - can see their team hierarchy
        $stats = [
            'team_members' => 0, // TODO: Implement team hierarchy
            'active_mentors' => 0,
            'total_leads' => 0, // TODO: Implement leads
        ];
        
        try {
            if (Schema::hasTable('roles') && Schema::hasTable('model_has_roles')) {
                $stats['active_mentors'] = User::role('mentor')->count();
            }
        } catch (\Throwable $e) {
            $stats['active_mentors'] = 0;
        }

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
        
        // Admin can view any dashboard. Guard role checks as above.
        $rolesAvailable = false;
        try {
            $rolesAvailable = Schema::hasTable('roles') && Schema::hasTable('model_has_roles');
        } catch (\Throwable $e) {
            $rolesAvailable = false;
        }

        if ($rolesAvailable) {
            try {
                if ($viewer->hasRole('admin')) {
                    return $this->getDashboardForUser($targetUser, $viewer, 'admin_viewing');
                }

                if ($viewer->hasRole('manager')) {
                    // TODO: Implement hierarchy checking
                    if ($targetUser->hasRole(['mentor', 'member'])) {
                        return $this->getDashboardForUser($targetUser, $viewer, 'manager_viewing');
                    }
                }

                if ($viewer->hasRole('mentor')) {
                    // TODO: Implement mentoring relationship checking
                    if ($targetUser->hasRole('member')) {
                        return $this->getDashboardForUser($targetUser, $viewer, 'mentor_viewing');
                    }
                }
            } catch (\Throwable $e) {
                // If role-based logic fails, fall through to unauthorized
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
        // Safe role checks: some test environments (sqlite) may not have Spatie tables.
        $isAdmin = $isManager = $isMentor = $isMember = false;
        try {
            if (Schema::hasTable('roles') && Schema::hasTable('model_has_roles')) {
                $isAdmin = method_exists($user, 'hasRole') && $user->hasRole('admin');
                $isManager = method_exists($user, 'hasRole') && $user->hasRole('manager');
                $isMentor = method_exists($user, 'hasRole') && $user->hasRole('mentor');
                $isMember = method_exists($user, 'hasRole') && $user->hasRole('member');
            }
        } catch (\Throwable $e) {
            $isAdmin = $isManager = $isMentor = $isMember = false;
        }

        if ($isAdmin) {
            return $this->adminDashboard($user)->with('viewingContext', $viewingContext);
        } elseif ($isManager) {
            return $this->managerDashboard($user)->with('viewingContext', $viewingContext);
        } elseif ($isMentor) {
            return $this->mentorDashboard($user)->with('viewingContext', $viewingContext);
        } elseif ($isMember) {
            return $this->memberDashboard($user)->with('viewingContext', $viewingContext);
        }
        
        return view('dashboards.default', compact('user'))->with('viewingContext', $viewingContext);
    }
}
