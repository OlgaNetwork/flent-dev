import React from 'react';

import type { SidebarType } from '@bangle.io/extension-registry';
import {
  Button,
  ChevronLeftIcon,
  CloseIcon,
  ErrorBoundary,
} from '@bangle.io/ui-components';

export function WorkspaceSidebar({
  onDismiss,
  sidebar,
  widescreen,
}: {
  onDismiss: () => void;
  sidebar: SidebarType;
  widescreen: boolean;
}) {
  return (
    <div
      data-testid="app-workspace-sidebar_workspace-sidebar"
      className=" flex flex-col flex-grow h-full border-1 border-l border-white smallscreen:min-h-screen"
    >
      <div className="absolute bottom-5 flex-row justify-between px-2 mt-3">
        <span>
          <Button
            variant="transparent"
            onPress={onDismiss}
            size="sm"
            ariaLabel={'Hide ' + sidebar.title}
            tooltipPlacement="bottom"
            leftIcon={widescreen ? <ChevronLeftIcon /> : <CloseIcon />}
          />
        </span>
      </div>
      <ErrorBoundary>
        <sidebar.ReactComponent />
      </ErrorBoundary>
    </div>
  );
}
