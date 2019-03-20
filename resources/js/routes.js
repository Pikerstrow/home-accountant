import StatementsComponent from './components/StatementsComponent';
import CalendarComponent from './components/CalendarComponent';
import ExpensesComponent from './components/ExpensesComponent';

export const routes = [
    {path: '/', name: 'statement', component: StatementsComponent},
    {path: '/calendar', name: 'calendar', component: CalendarComponent},
    {path: '/expenses', name: 'expenses', component: ExpensesComponent},
];