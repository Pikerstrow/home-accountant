import StatementsComponent from './components/StatementsComponent';
import CalendarComponent from './components/CalendarComponent';
import ExpensesComponent from './components/ExpensesComponent';
import CostItemsComponent from './components/CostItemsComponent';

export const routes = [
    {path: '/', name: 'statement', component: StatementsComponent},
    {path: '/calendar', name: 'calendar', component: CalendarComponent},
    {path: '/expenses', name: 'expenses', component: ExpensesComponent},
    {path: '/cost-items', name: 'cost-items', component: CostItemsComponent},
];