---
name: livewire-development
description: >-
  Develops reactive Livewire 3 components. Activates when creating, updating, or modifying
  Livewire components; working with wire:model, wire:click, wire:loading, or any wire: directives;
  adding real-time updates, loading states, or reactivity; debugging component behavior;
  writing Livewire tests; or when the user mentions Livewire, component, counter, or reactive UI.
---
<?php
/** @var \Laravel\Boost\Install\GuidelineAssist $assist */
?>
# Livewire Development

## When to Apply

Activate this skill when:
- Creating new Livewire components
- Modifying existing component state or behavior
- Debugging reactivity or lifecycle issues
- Writing Livewire component tests
- Adding Alpine.js interactivity to components
- Working with wire: directives

## Documentation

Use ___SINGLE_BACKTICK___search-docs___SINGLE_BACKTICK___ for detailed Livewire 3 patterns and documentation.

## Basic Usage

### Creating Components

Use the ___SINGLE_BACKTICK___<?php echo e($assist->artisanCommand('make:livewire [Posts\\CreatePost]')); ?>___SINGLE_BACKTICK___ Artisan command to create new components.

### Fundamental Concepts

- State should live on the server, with the UI reflecting it.
- All Livewire requests hit the Laravel backend; they're like regular HTTP requests. Always validate form data and run authorization checks in Livewire actions.

## Livewire 3 Specifics

### Key Changes From Livewire 2

These things changed in Livewire 3, but may not have been updated in this application. Verify this application's setup to ensure you follow existing conventions.
- Use ___SINGLE_BACKTICK___wire:model.live___SINGLE_BACKTICK___ for real-time updates, ___SINGLE_BACKTICK___wire:model___SINGLE_BACKTICK___ is now deferred by default.
- Components now use the ___SINGLE_BACKTICK___App\Livewire___SINGLE_BACKTICK___ namespace (not ___SINGLE_BACKTICK___App\Http\Livewire___SINGLE_BACKTICK___).
- Use ___SINGLE_BACKTICK___$this->dispatch()___SINGLE_BACKTICK___ to dispatch events (not ___SINGLE_BACKTICK___emit___SINGLE_BACKTICK___ or ___SINGLE_BACKTICK___dispatchBrowserEvent___SINGLE_BACKTICK___).
- Use the ___SINGLE_BACKTICK___components.layouts.app___SINGLE_BACKTICK___ view as the typical layout path (not ___SINGLE_BACKTICK___layouts.app___SINGLE_BACKTICK___).

### New Directives

- ___SINGLE_BACKTICK___wire:show___SINGLE_BACKTICK___, ___SINGLE_BACKTICK___wire:transition___SINGLE_BACKTICK___, ___SINGLE_BACKTICK___wire:cloak___SINGLE_BACKTICK___, ___SINGLE_BACKTICK___wire:offline___SINGLE_BACKTICK___, ___SINGLE_BACKTICK___wire:target___SINGLE_BACKTICK___ are available for use.

### Alpine Integration

- Alpine is now included with Livewire; don't manually include Alpine.js.
- Plugins included with Alpine: persist, intersect, collapse, and focus.

## Best Practices

### Component Structure

- Livewire components require a single root element.
- Use ___SINGLE_BACKTICK___wire:loading___SINGLE_BACKTICK___ and ___SINGLE_BACKTICK___wire:dirty___SINGLE_BACKTICK___ for delightful loading states.

### Using Keys in Loops
___BOOST_SNIPPET_0___

### Lifecycle Hooks

Prefer lifecycle hooks like ___SINGLE_BACKTICK___mount()___SINGLE_BACKTICK___, ___SINGLE_BACKTICK___updatedFoo()___SINGLE_BACKTICK___ for initialization and reactive side effects:

___BOOST_SNIPPET_1___

## JavaScript Hooks

You can listen for ___SINGLE_BACKTICK___livewire:init___SINGLE_BACKTICK___ to hook into Livewire initialization:

___BOOST_SNIPPET_2___

## Testing

___BOOST_SNIPPET_3___

___BOOST_SNIPPET_4___

## Common Pitfalls

- Forgetting ___SINGLE_BACKTICK___wire:key___SINGLE_BACKTICK___ in loops causes unexpected behavior when items change
- Using ___SINGLE_BACKTICK___wire:model___SINGLE_BACKTICK___ expecting real-time updates (use ___SINGLE_BACKTICK___wire:model.live___SINGLE_BACKTICK___ instead in v3)
- Not validating/authorizing in Livewire actions (treat them like HTTP requests)
- Including Alpine.js separately when it's already bundled with Livewire 3
<?php /**PATH C:\Users\DELL\Desktop\LARAVEL\StudentAttendenceSystem\storage\framework\views/a109bfaa40479ca840d9ee2c7b15a4fc.blade.php ENDPATH**/ ?>