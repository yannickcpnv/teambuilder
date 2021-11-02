/**
 * Confirm pop up when a moderator nominate a member to be moderator.
 *
 * @param {Event} event
 */
function confirmModeratorNomination (event)
{
  if (!confirm('Voulez-vous vraiment nommer ce membre comme modérateur ?')) {
    event.preventDefault()
  }
}
