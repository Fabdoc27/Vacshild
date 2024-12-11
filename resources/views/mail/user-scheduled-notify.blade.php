<x-mail::message>
# Vaccination Scheduled

Dear {{ $user->name }},

We are pleased to inform you that your vaccination has been scheduled.

<x-mail::panel>
**Scheduled Date:** {{ $scheduledDate }}
</x-mail::panel>

Please ensure to visit the vaccine center on the specified date.

Thanks,
{{ config('app.name') }}
</x-mail::message>
