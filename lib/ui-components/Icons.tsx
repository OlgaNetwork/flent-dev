import React from 'react';

import { vars } from '@bangle.io/css-vars';
import { cx } from '@bangle.io/utils';

export const Svg = ({
  children,
  style = {},
  size,
  className = '',
  ...props
}: {
  children: React.ReactNode;
  style?: React.CSSProperties;
  size?: number;
  className?: string;
} & React.SVGProps<SVGSVGElement>) => (
  <svg
    style={style}
    fill="currentColor"
    viewBox="0 0 24 24"
    xmlns="http://www.w3.org/2000/svg"
    className={`${size ? `h-${size} w-${size}` : ''} ${className}`}
    {...props}
  >
    {children}
  </svg>
);

export const ChevronDownIcon2 = (props: React.SVGProps<SVGSVGElement>) => (
  <Svg {...props}>
    <path d="M6.343 7.757L4.93 9.172 12 16.242l7.071-7.07-1.414-1.415L12 13.414 6.343 7.757z" />
  </Svg>
);

export const ChevronDownIcon = (props: React.SVGProps<SVGSVGElement>) => (
  <Svg {...props}>
    <path d="M6.343 7.757L4.93 9.172 12 16.242l7.071-7.07-1.414-1.415L12 13.414 6.343 7.757z" />
  </Svg>
);

export const ChevronUpIcon = (props: React.SVGProps<SVGSVGElement>) => (
  <Svg {...props}>
    <path
      d="M17.657 16.243l1.414-1.414-7.07-7.072-7.072 7.072 1.414 1.414L12 10.586l5.657 5.657z"
      fill="currentColor"
    />
  </Svg>
);

export const CloseIcon = (props: React.SVGProps<SVGSVGElement>) => (
  <Svg {...props}>
    <path
      d="M6.2253 4.81108C5.83477 4.42056 5.20161 4.42056 4.81108 4.81108C4.42056 5.20161 4.42056 5.83477 4.81108 6.2253L10.5858 12L4.81114 17.7747C4.42062 18.1652 4.42062 18.7984 4.81114 19.1889C5.20167 19.5794 5.83483 19.5794 6.22535 19.1889L12 13.4142L17.7747 19.1889C18.1652 19.5794 18.7984 19.5794 19.1889 19.1889C19.5794 18.7984 19.5794 18.1652 19.1889 17.7747L13.4142 12L19.189 6.2253C19.5795 5.83477 19.5795 5.20161 19.189 4.81108C18.7985 4.42056 18.1653 4.42056 17.7748 4.81108L12 10.5858L6.2253 4.81108Z"
      fill="currentColor"
    />
  </Svg>
);


export const ArrowsExpand = (props: React.SVGProps<SVGSVGElement>) => (
  <svg
    xmlns="http://www.w3.org/2000/svg"
    fill="none"
    viewBox="0 0 24 24"
    stroke="currentColor"
    strokeWidth={2}
    {...props}
  >
    <path
      strokeLinecap="round"
      strokeLinejoin="round"
      d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"
    />
  </svg>
);
export function TerminalIcon(props: React.SVGProps<SVGSVGElement>) {
  return (
    <Svg {...props}>
      <path
        d="M5.0333 14.8284L6.44751 16.2426L10.6902 12L6.44751 7.75733L5.0333 9.17155L7.86172 12L5.0333 14.8284Z"
        fill="currentColor"
      />
      <path d="M15 14H11V16H15V14Z" fill="currentColor" />
      <path
        fillRule="evenodd"
        clipRule="evenodd"
        fill="currentColor"
        d="M2 2C0.895431 2 0 2.89543 0 4V20C0 21.1046 0.89543 22 2 22H22C23.1046 22 24 21.1046 24 20V4C24 2.89543 23.1046 2 22 2H2ZM22 4H2L2 20H22V4Z"
      />
    </Svg>
  );
}

export function InfobarIcon(props: React.SVGProps<SVGSVGElement>) {
  return (
    <Svg {...props}>
      <path d="M16 7C15.4477 7 15 7.44772 15 8C15 8.55228 15.4477 9 16 9H19C19.5523 9 20 8.55228 20 8C20 7.44772 19.5523 7 19 7H16Z" />
      <path d="M15 12C15 11.4477 15.4477 11 16 11H19C19.5523 11 20 11.4477 20 12C20 12.5523 19.5523 13 19 13H16C15.4477 13 15 12.5523 15 12Z" />
      <path d="M16 15C15.4477 15 15 15.4477 15 16C15 16.5523 15.4477 17 16 17H19C19.5523 17 20 16.5523 20 16C20 15.4477 19.5523 15 19 15H16Z" />
      <path
        fillRule="evenodd"
        clipRule="evenodd"
        d="M3 3C1.34315 3 0 4.34315 0 6V18C0 19.6569 1.34315 21 3 21H21C22.6569 21 24 19.6569 24 18V6C24 4.34315 22.6569 3 21 3H3ZM21 5H13V19H21C21.5523 19 22 18.5523 22 18V6C22 5.44772 21.5523 5 21 5ZM3 5H11V19H3C2.44772 19 2 18.5523 2 18V6C2 5.44772 2.44772 5 3 5Z"
      />
    </Svg>
  );
}

export function AlbumIcon(props: React.SVGProps<SVGSVGElement>) {
  return (
    <Svg {...props}>
      <path
        fillRule="evenodd"
        clipRule="evenodd"
        d="M2 19C2 20.6569 3.34315 22 5 22H19C20.6569 22 22 20.6569 22 19V5C22 3.34315 20.6569 2 19 2H5C3.34315 2 2 3.34315 2 5V19ZM20 19C20 19.5523 19.5523 20 19 20H5C4.44772 20 4 19.5523 4 19V5C4 4.44772 4.44772 4 5 4H10V12.0111L12.395 12.0112L14.0001 9.86419L15.6051 12.0112H18.0001L18 4H19C19.5523 4 20 4.44772 20 5V19ZM16 4H12V9.33585L14.0001 6.66046L16 9.33571V4Z"
        fill="currentColor"
      />
    </Svg>
  );
}

export function BrowseIcon(props: React.SVGProps<SVGSVGElement>) {
  return (
    <Svg {...props}>
      <path
        fillRule="evenodd"
        clipRule="evenodd"
        d="M14.364 13.1214C15.2876 14.045 15.4831 15.4211 14.9504 16.5362L16.4853 18.0711C16.8758 18.4616 16.8758 19.0948 16.4853 19.4853C16.0948 19.8758 15.4616 19.8758 15.0711 19.4853L13.5361 17.9504C12.421 18.4831 11.045 18.2876 10.1213 17.364C8.94975 16.1924 8.94975 14.2929 10.1213 13.1214C11.2929 11.9498 13.1924 11.9498 14.364 13.1214ZM12.9497 15.9498C13.3403 15.5593 13.3403 14.9261 12.9497 14.5356C12.5592 14.145 11.9261 14.145 11.5355 14.5356C11.145 14.9261 11.145 15.5593 11.5355 15.9498C11.9261 16.3403 12.5592 16.3403 12.9497 15.9498Z"
        fill="currentColor"
      />
      <path d="M8 5H16V7H8V5Z" fill="currentColor" />
      <path d="M16 9H8V11H16V9Z" fill="currentColor" />
      <path
        fillRule="evenodd"
        clipRule="evenodd"
        d="M4 4C4 2.34315 5.34315 1 7 1H17C18.6569 1 20 2.34315 20 4V20C20 21.6569 18.6569 23 17 23H7C5.34315 23 4 21.6569 4 20V4ZM7 3H17C17.5523 3 18 3.44772 18 4V20C18 20.5523 17.5523 21 17 21H7C6.44772 21 6 20.5523 6 20V4C6 3.44772 6.44771 3 7 3Z"
        fill="currentColor"
      />
    </Svg>
  );
}

export function FileDocumentIcon(props: React.SVGProps<SVGSVGElement>) {
  return (
    <Svg {...props}>
      <path d="M7 18H17V16H7V18Z" fill="currentColor" />
      <path d="M17 14H7V12H17V14Z" fill="currentColor" />
      <path d="M7 10H11V8H7V10Z" fill="currentColor" />
      <path
        fillRule="evenodd"
        clipRule="evenodd"
        d="M6 2C4.34315 2 3 3.34315 3 5V19C3 20.6569 4.34315 22 6 22H18C19.6569 22 21 20.6569 21 19V9C21 5.13401 17.866 2 14 2H6ZM6 4H13V9H19V19C19 19.5523 18.5523 20 18 20H6C5.44772 20 5 19.5523 5 19V5C5 4.44772 5.44772 4 6 4ZM15 4.10002C16.6113 4.4271 17.9413 5.52906 18.584 7H15V4.10002Z"
        fill="currentColor"
      />
    </Svg>
  );
}

export function SecondaryEditorIcon(props: React.SVGProps<SVGSVGElement>) {
  return (
    <svg xmlns="http://www.w3.org/2000/svg"
    {...props} 
    width="24" height="24" 
    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
    stroke-linecap="round" stroke-linejoin="round">
    <rect width="18" height="18" x="3" y="3" rx="2"/>
    <path d="M12 3v18"/></svg>
  );
}

export function MoreAltIcon(props: React.SVGProps<SVGSVGElement>) {
  return (
    <Svg {...props} fill="none">
      <path
        d="M8 12C8 13.1046 7.10457 14 6 14C4.89543 14 4 13.1046 4 12C4 10.8954 4.89543 10 6 10C7.10457 10 8 10.8954 8 12Z"
        fill="currentColor"
      />
      <path
        d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z"
        fill="currentColor"
      />
      <path
        d="M18 14C19.1046 14 20 13.1046 20 12C20 10.8954 19.1046 10 18 10C16.8954 10 16 10.8954 16 12C16 13.1046 16.8954 14 18 14Z"
        fill="currentColor"
      />
    </Svg>
  );
}

export function ChevronDoubleRightIcon(props: React.SVGProps<SVGSVGElement>) {
  return (
    <svg xmlns="http://www.w3.org/2000/svg" {...props} fill="none">
      <path
        d="M5.63605 7.75735L7.05026 6.34314L12.7071 12L7.05029 17.6568L5.63608 16.2426L9.87869 12L5.63605 7.75735Z"
        fill="currentColor"
      />
      <path
        d="M12.7071 6.34314L11.2929 7.75735L15.5356 12L11.2929 16.2426L12.7072 17.6568L18.364 12L12.7071 6.34314Z"
        fill="currentColor"
      />
    </svg>
  );
}

export function NullIcon(props: React.SVGProps<SVGSVGElement>) {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      stroke="currentColor"
      {...props}
    ></svg>
  );
}

export function DocumentAddIcon(props: React.SVGProps<SVGSVGElement>) {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      stroke="currentColor"
      {...props}
    >
      <path
        strokeLinecap="round"
        strokeLinejoin="round"
        strokeWidth="2"
        d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
      />
    </svg>
  );
}

export function MenuIcon(props: React.SVGProps<SVGSVGElement>) {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      stroke="currentColor"
      {...props}
    >
      <path
        strokeLinecap="round"
        strokeLinejoin="round"
        strokeWidth={2}
        d="M4 6h16M4 12h16M4 18h16"
      />
    </svg>
  );
}

export function SpinnerIcon({ className = '', ...props }) {
  return (
    <svg
      aria-label="search spinner"
      className={'B-ui-components_spinner-icon ' + className}
      viewBox="0 0 100 100"
      xmlns="http://www.w3.org/2000/svg"
      stroke="currentColor"
      {...props}
    >
      <circle cx="50" cy="50" r="45" />
    </svg>
  );
}

export function ExclamationCircleIcon({ className = 'w-6 h-6', ...props }) {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      stroke="currentColor"
      className={className}
      {...props}
    >
      <path
        strokeLinecap="round"
        strokeLinejoin="round"
        strokeWidth={2}
        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
      />
    </svg>
  );
}

export function ExclamationIcon({ className = 'w-6 h-6', ...props }) {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      stroke="currentColor"
      className={className}
      {...props}
    >
      <path
        strokeLinecap="round"
        strokeLinejoin="round"
        strokeWidth={2}
        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
      />
    </svg>
  );
}

export function InformationCircleIcon({ className = 'w-6 h-6', ...props }) {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      stroke="currentColor"
      className={className}
      {...props}
    >
      <path
        strokeLinecap="round"
        strokeLinejoin="round"
        strokeWidth={2}
        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
      />
    </svg>
  );
}

export function CheckCircleIcon({ className = 'w-6 h-6', ...props }) {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      stroke="currentColor"
      className={className}
      {...props}
    >
      <path
        strokeLinecap="round"
        strokeLinejoin="round"
        strokeWidth={2}
        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
      />
    </svg>
  );
}

export function QuestionIcon({ className = 'w-6 h-6', ...props }) {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      fill="white"
      viewBox="0 0 70 70"
      stroke="currentColor"
      className={className}
      {...props}
    >
      <text
        x="25%"
        y="70"
        strokeWidth={2}
        fontSize="90px"
        fontWeight={300}
        style={
          {
            // font: 'regular 70px sans-serif',
          }
        }
      >
        ?
      </text>
    </svg>
  );
}

export function HomeIcon(props: React.SVGProps<SVGSVGElement>) {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      stroke="currentColor"
      {...props}
    >
      <path
        strokeLinecap="round"
        strokeLinejoin="round"
        strokeWidth="2px"
        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
      />
    </svg>
  );
}

export function SingleCharIcon({ char, ...props }: { char: string } & any) {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      fill="currentColor"
      viewBox="0 0 24 24"
      stroke="currentColor"
      {...props}
    >
      <circle r="11" cx="12" cy="12" strokeWidth="2" style={{ fill: 'none' }} />
      <text
        alignmentBaseline="central"
        x="50%"
        y="50%"
        strokeWidth="0"
        textAnchor="middle"
      >
        {char}
      </text>
    </svg>
  );
}

export function FolderIcon(props: React.SVGProps<SVGSVGElement>) {
  return (
    <svg 
    {...props}
    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
    stroke="currentColor" 
    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
    <path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"/><path d="M2 10h20"/>
    </svg>
  );
}

export function NewNoteIcon(props: React.SVGProps<SVGSVGElement>) {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      stroke="currentColor"
      {...props}
    >
      <path
        strokeLinecap="round"
        strokeLinejoin="round"
        strokeWidth={2}
        d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
      />
    </svg>
  );
}

export function NoteIcon(props: React.SVGProps<SVGSVGElement>) {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 18 18"
      stroke="currentColor"
      {...props}
    >
      <path d="M10,5.5V1H3.5a.5.5,0,0,0-.5.5v15a.5.5,0,0,0,.5.5h11a.5.5,0,0,0,.5-.5V6H10.5A.5.5,0,0,1,10,5.5Z" />
      <path d="M11,1h.043a.5.5,0,0,1,.3535.1465l3.457,3.457A.5.5,0,0,1,15,4.957V5H11Z" />
    </svg>
  );
}

export function SearchIcon(props: React.SVGProps<SVGSVGElement>) {
  return (
    <svg 
    {...props}
    xmlns="http://www.w3.org/2000/svg" 
    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" 
    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
    <circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>
    </svg>
  );
}

export function GiftIcon({ showDot = false, ...props }) {
  return (
<svg  {...props} xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="8" width="18" height="4" rx="1"/><path d="M12 8v13"/>
<path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"/><path d="M7.5 8a2.5 2.5 0 0 1 0-5A4.8 8 0 0 1 12 8a4.8 8 0 0 1 4.5-5 2.5 2.5 0 0 1 0 5"/></svg>
  );
}

export function SettingsIcon(props: any) {
  return (
    <svg 
    {...props}
    xmlns="http://www.w3.org/2000/svg" 
    width="24" height="24" viewBox="0 0 24 24" 
    fill="none" stroke="currentColor" stroke-width="1.5" 
    stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/>
    </svg>
  );
}

export function DotsVerticalIcon(props: React.SVGProps<SVGSVGElement>) {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      {...props}
      viewBox="0 0 20 20"
      fill="currentColor"
    >
      <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
    </svg>
  );
}
export function EditIcon(props: any) {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      height="18"
      viewBox="0 0 18 18"
      fill="currentColor"
      {...props}
    >
      <path d="M16.7835,4.1,13.9,1.216a.60751.60751,0,0,0-.433-.1765H13.45a.6855.6855,0,0,0-.4635.203L2.542,11.686a.49494.49494,0,0,0-.1255.211L1.0275,16.55c-.057.1885.2295.4255.3915.4255a.12544.12544,0,0,0,.031-.0035c.138-.0315,3.933-1.172,4.6555-1.389a.486.486,0,0,0,.207-.1245L16.7565,5.014a.686.686,0,0,0,.2-.4415A.61049.61049,0,0,0,16.7835,4.1ZM5.7,14.658c-1.0805.3245-2.431.7325-3.3645,1.011L3.34,12.304Z" />
    </svg>
  );
}
export function NoEditIcon(props: any) {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      height="18"
      viewBox="0 0 18 18"
      fill="currentColor"
      {...props}
    >
      <rect
        height="21.927"
        rx="0.409"
        transform="translate(-3.72777 9.00002) rotate(-45)"
        width="1.2275"
        x="8.38635"
        y="-1.96368"
      />
      <path d="M5.5905,8.6375l-3.05,3.05a.5.5,0,0,0-.1255.2105L1.028,16.55c-.057.188.2295.425.3915.425a.15022.15022,0,0,0,.0305-.003c.138-.032,3.9335-1.172,4.656-1.3895a.48708.48708,0,0,0,.207-.1245l3.05-3.05ZM2.334,15.669l1.0045-3.3655,2.36,2.354C4.618,14.9825,3.2675,15.3905,2.334,15.669Z" />
      <path d="M16.7835,4.1,13.9,1.216a.60751.60751,0,0,0-.4335-.1765H13.45a.6855.6855,0,0,0-.4635.203l-4.4,4.312,3.7715,3.771,4.4-4.3115a.68751.68751,0,0,0,.2-.4415A.61148.61148,0,0,0,16.7835,4.1Z" />
    </svg>
  );
}

export function ChevronLeftIcon(props: any) {
  return (
    <svg xmlns="http://www.w3.org/2000/svg" 
    {...props}
    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" 
    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <path d="m15 18-6-6 6-6"/>
    </svg>
  );
}
export function ChevronRightIcon(props: any) {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 18 18"
      fill="currentColor"
      {...props}
    >
      <rect fill="#ff13dc" opacity="0" width="18" height="18" />
      <path d="M12,9a.994.994,0,0,1-.2925.7045l-3.9915,3.99a1,1,0,1,1-1.4355-1.386l.0245-.0245L9.5905,9,6.3045,5.715A1,1,0,0,1,7.691,4.28l.0245.0245,3.9915,3.99A.994.994,0,0,1,12,9Z" />
    </svg>
  );
}
export function ChevronDoubleLeftIcon(props: any) {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 18 18"
      fill="currentColor"
      {...props}
    >
      <path d="M3,9a.994.994,0,0,0,.2925.7045l3.9915,3.99a1,1,0,1,0,1.4355-1.386L8.695,12.284,5.4095,9l3.286-3.285A1,1,0,0,0,7.309,4.28l-.0245.0245L3.293,8.2945A.994.994,0,0,0,3,9Z" />
      <path d="M9,9a.994.994,0,0,0,.2925.7045l3.9915,3.99a1,1,0,1,0,1.4355-1.386l-.0245-.0245L11.4095,9l3.286-3.285A1,1,0,0,0,13.309,4.28l-.0245.0245L9.293,8.2945A.994.994,0,0,0,9,9Z" />
    </svg>
  );
}

export function MoreIcon(props: any) {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      height="18"
      viewBox="0 0 18 18"
      width="18"
      fill="currentColor"
      {...props}
    >
      <path
        className="a"
        d="M16.45,7.8965H14.8945a5.97644,5.97644,0,0,0-.921-2.2535L15.076,4.54a.55.55,0,0,0,.00219-.77781L15.076,3.76l-.8365-.836a.55.55,0,0,0-.77781-.00219L13.4595,2.924,12.357,4.0265a5.96235,5.96235,0,0,0-2.2535-.9205V1.55a.55.55,0,0,0-.55-.55H8.45a.55.55,0,0,0-.55.55V3.106a5.96235,5.96235,0,0,0-2.2535.9205l-1.1-1.1025a.55.55,0,0,0-.77781-.00219L3.7665,2.924,2.924,3.76a.55.55,0,0,0-.00219.77781L2.924,4.54,4.0265,5.643a5.97644,5.97644,0,0,0-.921,2.2535H1.55a.55.55,0,0,0-.55.55V9.55a.55.55,0,0,0,.55.55H3.1055a5.967,5.967,0,0,0,.921,2.2535L2.924,13.4595a.55.55,0,0,0-.00219.77782l.00219.00218.8365.8365a.55.55,0,0,0,.77781.00219L4.5405,15.076,5.643,13.9735a5.96235,5.96235,0,0,0,2.2535.9205V16.45a.55.55,0,0,0,.55.55H9.55a.55.55,0,0,0,.55-.55V14.894a5.96235,5.96235,0,0,0,2.2535-.9205L13.456,15.076a.55.55,0,0,0,.77782.00219L14.236,15.076l.8365-.8365a.55.55,0,0,0,.00219-.77781l-.00219-.00219L13.97,12.357a5.967,5.967,0,0,0,.921-2.2535H16.45a.55.55,0,0,0,.55-.55V8.45a.55.55,0,0,0-.54649-.55349ZM11.207,9A2.207,2.207,0,1,1,9,6.793H9A2.207,2.207,0,0,1,11.207,9Z"
      />
    </svg>
  );
}

export function MoreSmallListIcon(props: any) {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      height="18"
      viewBox="0 0 18 18"
      width="18"
      fill="currentColor"
      {...props}
    >
      <circle cx="4.5" cy="9" r="1.425" />
      <circle cx="9" cy="9" r="1.425" />
      <circle cx="13.5" cy="9" r="1.425" />
    </svg>
  );
}

export function TwitterIcon(props: any) {
  return (
    <svg {...props} xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <path d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z"/><path d="m21.854 2.147-10.94 10.939"/></svg>
  );
}

export function DiscordIcon(props: any) {
  return (
<svg {...props} width="24.000000" height="24.000000" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
  <defs>
    <clipPath id="clip4_1970">
      <rect id="svg" width="24.000000" height="24.000000" fill="white" fill-opacity="0"/>
    </clipPath>
  </defs>
  <g clip-path="url(#clip4_1970)">
    <path id="path" d="M4.96 7.9C4.42 7.9 3.95 7.71 3.57 7.33C3.19 6.95 3 6.49 3 5.95C3 5.41 3.19 4.95 3.57 4.57C3.95 4.19 4.42 4 4.96 4C5.5 4 5.97 4.19 6.35 4.57C6.73 4.95 6.93 5.41 6.93 5.95C6.93 6.49 6.73 6.95 6.35 7.33C5.97 7.71 5.5 7.9 4.96 7.9Z" fill="#000000" fill-opacity="1.000000" fill-rule="nonzero"/>
    <path id="path" d="M13.46 7.9C12.92 7.9 12.46 7.71 12.07 7.33C11.69 6.95 11.5 6.49 11.5 5.95C11.5 5.41 11.69 4.95 12.07 4.57C12.46 4.19 12.92 4 13.46 4C14 4 14.47 4.19 14.85 4.57C15.24 4.95 15.43 5.41 15.43 5.95C15.43 6.49 15.24 6.95 14.85 7.33C14.47 7.71 14 7.9 13.46 7.9Z" fill="#000000" fill-opacity="1.000000" fill-rule="nonzero"/>
    <path id="path" d="M21.98 7.9C21.44 7.9 20.97 7.71 20.59 7.33C20.2 6.95 20.01 6.49 20.01 5.95C20.01 5.41 20.2 4.95 20.59 4.57C20.97 4.19 21.44 4 21.98 4C22.52 4 22.98 4.19 23.37 4.57C23.75 4.95 23.94 5.41 23.94 5.95C23.95 6.49 23.76 6.95 23.37 7.33C22.99 7.71 22.52 7.9 21.98 7.9Z" fill="#000000" fill-opacity="1.000000" fill-rule="nonzero"/>
    <path id="path" d="M30.5 7.9C29.95 7.9 29.49 7.71 29.11 7.33C28.72 6.95 28.53 6.49 28.53 5.95C28.53 5.41 28.72 4.95 29.11 4.57C29.49 4.19 29.95 4 30.5 4C31.04 4 31.5 4.19 31.88 4.57C32.27 4.95 32.46 5.41 32.46 5.95C32.46 6.49 32.27 6.95 31.89 7.33C31.5 7.71 31.04 7.9 30.5 7.9Z" fill="#000000" fill-opacity="1.000000" fill-rule="nonzero"/>
    <path id="path" d="M39 7.9C38.45 7.9 37.99 7.71 37.61 7.33C37.22 6.95 37.03 6.49 37.03 5.95C37.03 5.41 37.22 4.95 37.61 4.57C37.99 4.19 38.45 4 39 4C39.54 4 40 4.19 40.39 4.57C40.77 4.95 40.96 5.41 40.96 5.95C40.96 6.49 40.77 6.95 40.39 7.33C40 7.71 39.54 7.9 39 7.9Z" fill="#000000" fill-opacity="1.000000" fill-rule="nonzero"/>
    <path id="path" d="M47.51 7.9C46.97 7.9 46.51 7.71 46.12 7.33C45.74 6.95 45.55 6.49 45.55 5.95C45.55 5.41 45.74 4.95 46.12 4.57C46.51 4.19 46.97 4 47.51 4C48.06 4 48.52 4.19 48.9 4.57C49.29 4.95 49.48 5.41 49.48 5.95C49.48 6.49 49.29 6.95 48.91 7.33C48.52 7.71 48.06 7.9 47.51 7.9Z" fill="#000000" fill-opacity="1.000000" fill-rule="nonzero"/>
    <path id="path" d="M56.03 7.9C55.49 7.9 55.02 7.71 54.64 7.33C54.26 6.95 54.06 6.49 54.06 5.95C54.06 5.41 54.26 4.95 54.64 4.57C55.02 4.19 55.49 4 56.03 4C56.57 4 57.04 4.19 57.42 4.57C57.8 4.95 58 5.41 58 5.95C58 6.49 57.81 6.95 57.42 7.33C57.04 7.71 56.57 7.9 56.03 7.9Z" fill="#000000" fill-opacity="1.000000" fill-rule="nonzero"/>
    <path id="path" d="M39.11 20.72L13.35 20.72C12.21 20.62 11.65 20 11.65 18.88C11.65 17.75 12.21 17.13 13.35 17.03L39.11 17.03C40.25 17.13 40.81 17.75 40.81 18.88C40.81 20 40.25 20.62 39.11 20.72Z" fill="#000000" fill-opacity="1.000000" fill-rule="nonzero"/>
    <path id="path" d="M4.96 20.83C4.42 20.83 3.95 20.64 3.57 20.26C3.19 19.88 3 19.42 3 18.88C3 18.34 3.19 17.88 3.57 17.5C3.95 17.12 4.42 16.93 4.96 16.93C5.5 16.93 5.97 17.12 6.35 17.5C6.73 17.88 6.93 18.34 6.93 18.88C6.93 19.42 6.73 19.88 6.35 20.26C5.97 20.64 5.5 20.83 4.96 20.83Z" fill="#000000" fill-opacity="1.000000" fill-rule="nonzero"/>
    <path id="path" d="M47.51 20.83C46.97 20.83 46.51 20.64 46.12 20.26C45.74 19.88 45.55 19.42 45.55 18.88C45.55 18.34 45.74 17.88 46.12 17.5C46.51 17.12 46.97 16.93 47.51 16.93C48.06 16.93 48.52 17.12 48.9 17.5C49.29 17.88 49.48 18.34 49.48 18.88C49.48 19.42 49.29 19.89 48.91 20.27C48.52 20.65 48.06 20.84 47.51 20.83Z" fill="#000000" fill-opacity="1.000000" fill-rule="nonzero"/>
    <path id="path" d="M56.03 20.83C55.49 20.83 55.02 20.64 54.64 20.26C54.26 19.88 54.06 19.42 54.06 18.88C54.06 18.34 54.26 17.88 54.64 17.5C55.02 17.12 55.49 16.93 56.03 16.93C56.57 16.93 57.04 17.12 57.42 17.5C57.8 17.88 58 18.34 58 18.88C58 19.42 57.81 19.89 57.42 20.27C57.04 20.65 56.57 20.84 56.03 20.83Z" fill="#000000" fill-opacity="1.000000" fill-rule="nonzero"/>
    <path id="path" d="M9.24 14.37C8.7 14.37 8.23 14.18 7.85 13.8C7.47 13.42 7.28 12.96 7.28 12.42C7.28 11.88 7.47 11.42 7.85 11.04C8.23 10.66 8.7 10.47 9.24 10.47C9.78 10.47 10.25 10.66 10.63 11.04C11.01 11.42 11.21 11.88 11.21 12.42C11.21 12.96 11.01 13.42 10.63 13.8C10.25 14.18 9.78 14.37 9.24 14.37Z" fill="#000000" fill-opacity="1.000000" fill-rule="nonzero"/>
    <path id="path" d="M17.74 14.37C17.2 14.37 16.74 14.18 16.35 13.8C15.97 13.42 15.78 12.96 15.78 12.42C15.78 11.88 15.97 11.42 16.35 11.04C16.74 10.66 17.2 10.47 17.74 10.47C18.28 10.47 18.75 10.66 19.13 11.04C19.52 11.42 19.71 11.88 19.71 12.42C19.7 12.96 19.51 13.42 19.13 13.8C18.75 14.18 18.28 14.37 17.74 14.37Z" fill="#000000" fill-opacity="1.000000" fill-rule="nonzero"/>
    <path id="path" d="M26.26 14.37C25.72 14.37 25.25 14.18 24.87 13.8C24.49 13.42 24.29 12.96 24.29 12.42C24.29 11.88 24.49 11.42 24.87 11.04C25.25 10.66 25.72 10.47 26.26 10.47C26.8 10.47 27.26 10.66 27.65 11.04C28.03 11.42 28.22 11.88 28.22 12.42C28.22 12.96 28.03 13.42 27.64 13.8C27.26 14.18 26.8 14.37 26.26 14.37Z" fill="#000000" fill-opacity="1.000000" fill-rule="nonzero"/>
    <path id="path" d="M34.78 14.37C34.23 14.37 33.77 14.18 33.39 13.8C33 13.42 32.81 12.96 32.81 12.42C32.81 11.88 33 11.42 33.39 11.04C33.77 10.66 34.23 10.47 34.78 10.47C35.32 10.47 35.78 10.66 36.16 11.04C36.55 11.42 36.74 11.88 36.74 12.42C36.74 12.96 36.55 13.42 36.16 13.8C35.78 14.18 35.32 14.37 34.78 14.37Z" fill="#000000" fill-opacity="1.000000" fill-rule="nonzero"/>
    <path id="path" d="M43.28 14.37C42.73 14.37 42.27 14.18 41.89 13.8C41.5 13.42 41.31 12.96 41.31 12.42C41.31 11.88 41.5 11.42 41.89 11.04C42.27 10.66 42.73 10.47 43.28 10.47C43.82 10.47 44.28 10.66 44.67 11.04C45.05 11.42 45.24 11.88 45.24 12.42C45.24 12.96 45.04 13.42 44.66 13.8C44.28 14.18 43.82 14.37 43.28 14.37Z" fill="#000000" fill-opacity="1.000000" fill-rule="nonzero"/>
    <path id="path" d="M51.79 14.37C51.25 14.37 50.79 14.18 50.4 13.8C50.02 13.42 49.83 12.96 49.83 12.42C49.83 11.88 50.02 11.42 50.4 11.04C50.79 10.66 51.25 10.47 51.79 10.47C52.34 10.47 52.8 10.66 53.18 11.04C53.57 11.42 53.76 11.88 53.76 12.42C53.75 12.96 53.56 13.42 53.18 13.8C52.8 14.18 52.33 14.37 51.79 14.37Z" fill="#000000" fill-opacity="1.000000" fill-rule="nonzero"/>
  </g>
</svg>
  );
}

export function BangleIcon(props: any) {
  return (
<svg {...props} xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><path d="M12 17h.01"/></svg>
  );
}

export function GithubIcon(props: React.SVGProps<SVGSVGElement>) {
  return (
    <svg
      {...props}
      fill="currentColor"
      xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 64 64"
    >
      <path d="M32 6C17.641 6 6 17.641 6 32c0 12.277 8.512 22.56 19.955 25.286-.592-.141-1.179-.299-1.755-.479V50.85c0 0-.975.325-2.275.325-3.637 0-5.148-3.245-5.525-4.875-.229-.993-.827-1.934-1.469-2.509-.767-.684-1.126-.686-1.131-.92-.01-.491.658-.471.975-.471 1.625 0 2.857 1.729 3.429 2.623 1.417 2.207 2.938 2.577 3.721 2.577.975 0 1.817-.146 2.397-.426.268-1.888 1.108-3.57 2.478-4.774-6.097-1.219-10.4-4.716-10.4-10.4 0-2.928 1.175-5.619 3.133-7.792C19.333 23.641 19 22.494 19 20.625c0-1.235.086-2.751.65-4.225 0 0 3.708.026 7.205 3.338C28.469 19.268 30.196 19 32 19s3.531.268 5.145.738c3.497-3.312 7.205-3.338 7.205-3.338.567 1.474.65 2.99.65 4.225 0 2.015-.268 3.19-.432 3.697C46.466 26.475 47.6 29.124 47.6 32c0 5.684-4.303 9.181-10.4 10.4 1.628 1.43 2.6 3.513 2.6 5.85v8.557c-.576.181-1.162.338-1.755.479C49.488 54.56 58 44.277 58 32 58 17.641 46.359 6 32 6zM33.813 57.93C33.214 57.972 32.61 58 32 58 32.61 58 33.213 57.971 33.813 57.93zM37.786 57.346c-1.164.265-2.357.451-3.575.554C35.429 57.797 36.622 57.61 37.786 57.346zM32 58c-.61 0-1.214-.028-1.813-.07C30.787 57.971 31.39 58 32 58zM29.788 57.9c-1.217-.103-2.411-.289-3.574-.554C27.378 57.61 28.571 57.797 29.788 57.9z" />
    </svg>
  );
}

export function LoadingCircleIcon(props: React.SVGProps<SVGSVGElement>) {
  return (
    <svg
      {...props}
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      className={cx('animate-spin', props.className)}
    >
      <circle
        className="opacity-25"
        cx="12"
        cy="12"
        r="10"
        stroke="currentColor"
        strokeWidth="4"
      ></circle>
      <path
        className="opacity-75"
        fill="currentColor"
        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
      ></path>
    </svg>
  );
}
