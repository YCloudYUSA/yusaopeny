# [type(TICKET-ID)]: [Brief Description]

<!--
PR Title Format: type(TICKET-ID): Brief description
Types: feat, fix, docs, refactor, test, build, chore
Example: feat(ITCR-123): Add dynamic menu support
-->

## Summary

[1-2 sentences describing what this PR accomplishes]

---

## Changes Made

- [Main change 1]
- [Main change 2]
- [Main change 3]

<details>
<summary><strong>Technical Details</strong></summary>

### Backend Changes

- [Backend change details if applicable]

### Frontend Changes

- [Frontend change details if applicable]

### Configuration Changes

- [Configuration changes if applicable]

### Database Changes

- [Schema changes, update hooks, etc. if applicable]

</details>

---

## Testing

- [ ] Unit tests added/updated
- [ ] Kernel tests added/updated
- [ ] Functional tests added/updated
- [ ] Manual testing completed
- [ ] Edge cases tested
- [ ] Drupal coding standards followed ([phpcs](https://www.drupal.org/docs/develop/standards/phpcs))
- [ ] Tested on supported PHP versions
- [ ] Tested on supported Drupal core versions

<details>
<summary><strong>Testing Instructions</strong></summary>

### Manual Testing Steps

1. [Step 1]
2. [Step 2]
3. [Step 3]

### Expected Results

- [Expected result 1]
- [Expected result 2]

</details>

---

## Related

### Issue/Ticket

- **[TICKET-ID]**: [Ticket Title](ticket-url)

### Closes

<!-- Use GitHub keywords: Closes, Fixes, Resolves -->
- Closes #[issue-number]

### Related To

- Related to #[issue-number]

### Related PRs

<!-- Specify relationship: Depends on, Follows, Blocks, Part of series -->
- **Depends on**: #[PR-number] - [Description]

---

## Drupal-Specific Checklist

### Code Quality

- [ ] Follows [Drupal Coding Standards](https://www.drupal.org/docs/develop/standards)
- [ ] Follows [Drupal Best Practices](https://www.drupal.org/docs/develop/standards/coding-standards)
- [ ] Uses [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/)
- [ ] No debug code (dpm, kint, console.log, etc.)
- [ ] Proper error handling and logging
- [ ] Security best practices followed

### Upgrade Path

- [ ] Update hooks provided (`hook_update_N`) for data/config changes
- [ ] Supports [upgrade path](https://github.com/YCloudYUSA/yusaopeny/blob/main/docs/Development/Upgrade%20path.md)
- [ ] Backwards compatible (or breaking change documented)
- [ ] Config export included (if applicable)

### Documentation

- [ ] [Documentation](https://github.com/YCloudYUSA/yusaopeny/tree/main/docs) updated
- [ ] Code comments added where needed
- [ ] README updated (if applicable)
- [ ] Change record created (if API/plugin change)
- [ ] Docblocks added/updated

### Drupal.org Contribution

- [ ] Git email associated with [Drupal.org account](https://www.drupal.org/)
- [ ] Ready for [Drupal.org credit](https://github.com/YCloudYUSA/yusaopeny/blob/main/docs/Development/Contributing.md#drupalorg-credits) (if desired)

---

## Breaking Changes

- [ ] No breaking changes
- [ ] Breaking changes documented below

<details>
<summary><strong>Breaking Changes Details</strong></summary>

### What's Breaking

[Describe what breaks and why]

### Migration Path

**Before**:
```php
// Old usage
```

**After**:
```php
// New usage
```

### Semantic Versioning

[e.g., Minor version bump: 11.0.x → 11.1.x]

</details>

---

## Success Criteria

- [ ] All acceptance criteria met (from ticket)
- [ ] Code reviewed and approved
- [ ] All tests passing
- [ ] Documentation complete
- [ ] Upgrade path verified
- [ ] Ready to merge

---

## Screenshots

<details>
<summary><strong>Visual Changes</strong></summary>

### Before

[Screenshot or description]

### After

[Screenshot or description]

</details>

---

## Areas Needing Feedback

<!-- Optional: List any specific areas where you need reviewer input -->

- [Area 1 needing feedback]
- [Area 2 needing feedback]

---

## Additional Notes

[Any additional context, concerns, or information for reviewers]

---

<!--
Reference Documentation:
- PR Guidelines: https://github.com/ITCare-Company/pulsepoint-ai.itcaresolutions.org/issues/83
- Drupal Coding Standards: https://www.drupal.org/docs/develop/standards
- Conventional Commits: https://www.conventionalcommits.org/
-->

**Template Version**: 1.0
**Source**: ITCare GitHub Templates
**Last Updated**: 2025-10-21
