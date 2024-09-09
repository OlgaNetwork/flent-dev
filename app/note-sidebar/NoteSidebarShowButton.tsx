import React from 'react';

import { Button, ChevronDoubleLeftIcon } from '@bangle.io/ui-components';

export function NoteSidebarShowButton({
  showNoteSidebar,
  widescreen,
  isNoteSidebarShown,
}: {
  showNoteSidebar: () => void;
  widescreen: boolean;
  isNoteSidebarShown: boolean;
}) {
  /*if (!widescreen || isNoteSidebarShown) {
    return null;
  }*/
  {
  return null;
}

  return (
    <Button
      style={{ display: 'none' }}
      ariaLabel="Show note sidebar"
      className="hidden right-5 bottom-5 z-30 border-r-0"
      tooltipPlacement="bottom"
      size="sm"
      variant="soft"
      onPress={() => {
        showNoteSidebar();
      }}
      leftIcon={<ChevronDoubleLeftIcon />}
    />
  );
}
