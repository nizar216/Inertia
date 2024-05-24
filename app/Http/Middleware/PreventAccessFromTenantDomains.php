<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\Builder;
class PreventAccessFromTenantDomains
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next)
    {
        $host = $request->getHost();

        $tenantModel = config('tenancy.tenant_model');
        $tenant = $tenantModel::query()
            ->whereHas('domains', function (Builder $query) use ($host) {
                $query->where('domain', $host);
            })
            ->with('domains')
            ->first();

        if ($tenant) {
            abort(404);
        }

        return $next($request);
    }
}
