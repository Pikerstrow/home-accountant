import StatementsComponent from './components/StatementsComponent';
import CalendarComponent from './components/CalendarComponent';
import ExpensesComponent from './components/ExpensesComponent';
import CostDirectionsComponent from './components/CostDirectionsComponent';

export const routes = [
    {path: '/', name: 'statement', component: StatementsComponent},
    {path: '/calendar', name: 'calendar', component: CalendarComponent},
    {path: '/expenses', name: 'expenses', component: ExpensesComponent},
    {path: '/cost-directions', name: 'cost-directions', component: CostDirectionsComponent},
];